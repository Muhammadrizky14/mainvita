<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spas = Spa::all();
        return view('admin.spas.index', compact('spas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Redirect to the existing form
        return redirect()->route('admin.formspa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // This method will not be used directly since we're using the existing route
        // The SpaController::store method will be used instead
        return redirect()->route('spa.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_spa
     * @return \Illuminate\Http\Response
     */
    public function show($id_spa)
    {
        $spa = Spa::findOrFail($id_spa);
        return view('admin.spas.show', compact('spa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_spa
     * @return \Illuminate\Http\Response
     */
    public function edit($id_spa)
    {
        $spa = Spa::findOrFail($id_spa);
        return view('admin.spas.edit', compact('spa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_spa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_spa)
    {
        $spa = Spa::findOrFail($id_spa);
        
        $data = $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'alamat' => 'required|string',
            'noHP' => 'required|string',
            'waktuBuka' => 'required|array',
            'waktuBuka.*' => 'required|string',
            'maps' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($spa->image && Storage::disk('public')->exists($spa->image)) {
                Storage::disk('public')->delete($spa->image);
            }
            
            $imagePath = $request->file('image')->store('spa_images', 'public');
            $data['image'] = $imagePath;
        }

        $spa->update($data);

        return redirect()->route('admin.spas.index')->with('success', 'Spa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_spa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_spa)
    {
        $spa = Spa::findOrFail($id_spa);
        
        // Delete image if exists
        if ($spa->image && Storage::disk('public')->exists($spa->image)) {
            Storage::disk('public')->delete($spa->image);
        }
        
        $spa->delete();
        
        return redirect()->route('admin.spas.index')->with('success', 'Spa berhasil dihapus');
    }
}
