<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use App\Models\SpaService;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function dashboard()
    {
        $spaCount = Spa::count();
        return view('admin.dashboard', compact('spaCount'));
    }

    public function index(Request $request)
    {
        $query = Spa::query();
        $searchPerformed = false;
        $searchCriteria = [];

        if ($request->filled('location')) {
            $query->where(function ($query) use ($request) {
                $query->where('alamat', 'like', '%' . $request->location . '%')
                    ->orWhere('nama', 'like', '%' . $request->location . '%');
            });
            $query->where('alamat', 'like', '%' . $request->location . '%');
            $searchPerformed = true;
            $searchCriteria[] = "lokasi: " . $request->location;
        }

        // Filter berdasarkan rentang harga
        if ($request->filled('min_price') || $request->filled('max_price')) {
            if ($request->filled('min_price')) {
                $query->where('harga', '>=', $request->min_price);
                $searchCriteria[] = "harga minimal: Rp " . number_format($request->min_price, 0, ',', '.');
            }
            if ($request->filled('max_price')) {
                $query->where('harga', '<=', $request->max_price);
                $searchCriteria[] = "harga maksimal: Rp " . number_format($request->max_price, 0, ',', '.');
            }
            $searchPerformed = true;
        }

        $spaTotal = $query->get();

        // Set status pencarian
        if ($searchPerformed) {
            $searchCriteriaString = implode(', ', $searchCriteria);
            if ($spaTotal->isEmpty()) {
                session()->flash('search_status', 'not_found');
                session()->flash('search_query', $searchCriteriaString);
            } else {
                session()->flash('search_status', 'success');
                session()->flash('search_query', $searchCriteriaString);
            }
        } else {
            session()->forget(['search_status', 'search_query']);
        }

        return view('fitur.spa', compact('spaTotal'));
    }

    public function create()
    {
        return view('admin.formspa');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'alamat' => 'required|string',
            'noHP' => 'required|string',
            'waktuBuka' => 'required|array',
            'waktuBuka.*' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'maps' => 'required|string'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/' . $imageName;
        }

        try {
            $spa = Spa::create($validatedData);
            
            // Create default services for this spa
            $defaultServices = [
                [
                    'name' => 'Body Massage (Full Body)',
                    'description' => 'Traditional Indonesian massage technique to relieve tension.',
                    'duration' => '1 hr',
                    'price' => 180000,
                    'is_active' => true
                ],
                [
                    'name' => 'Facial Treatment',
                    'description' => 'Rejuvenate your skin with our premium facial treatment.',
                    'duration' => '45 mins',
                    'price' => 175000,
                    'is_active' => true
                ],
                [
                    'name' => 'Body Scrub',
                    'description' => 'Exfoliate and refresh your skin with our natural body scrub.',
                    'duration' => '30 mins',
                    'price' => 150000,
                    'is_active' => true
                ]
            ];
            
            foreach ($defaultServices as $service) {
                $service['spa_id'] = $spa->id_spa;
                SpaService::create($service);
            }
            
            // Redirect to the index page after storing a new spa
            return redirect()->route('admin.spas.index')->with('success', 'Data SPA berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data SPA. Silakan coba lagi.');
        }
    }

    public function show(Spa $spa)
    {
        return view('admin.spaShow', compact('spa'));
    }

    public function edit(Spa $spa)
    {
        return view('admin.spaEdit', compact('spa'));
    }

    public function update(Request $request, Spa $spa)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'alamat' => 'required',
            'noHP' => 'required',
            'waktuBuka' => 'required'
        ]);

        $spa->update($validatedData);

        return redirect()->route('admin.spas.index')->with('success', 'Data SPA berhasil diperbarui');
    }

    public function destroy(Spa $spa)
    {
        $spa->delete();
        return redirect()->route('admin.spas.index')->with('success', 'Data SPA berhasil dihapus');
    }
}
