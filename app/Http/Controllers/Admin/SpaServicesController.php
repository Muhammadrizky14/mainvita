<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spa;
use App\Models\SpaService;

class SpaServicesController extends Controller
{
    public function index($spaId)
    {
        $spa = Spa::findOrFail($spaId);
        $services = $spa->services()->orderBy('name')->get();
        return view('admin.spa_services.index', compact('spa', 'services'));
    }

    public function create($spaId)
    {
        $spa = Spa::findOrFail($spaId);
        return view('admin.spa_services.create', compact('spa'));
    }

    public function store(Request $request, $spaId)
    {
        $spa = Spa::findOrFail($spaId);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['spa_id'] = $spa->id_spa;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        SpaService::create($validated);

        return redirect()->route('admin.spas.services.index', $spa->id_spa)
            ->with('success', 'Service added successfully!');
    }

    public function edit($spaId, $serviceId)
    {
        $spa = Spa::findOrFail($spaId);
        $service = SpaService::where('spa_id', $spaId)->findOrFail($serviceId);
        return view('admin.spa_services.edit', compact('spa', 'service'));
    }

    public function update(Request $request, $spaId, $serviceId)
    {
        $spa = Spa::findOrFail($spaId);
        $service = SpaService::where('spa_id', $spaId)->findOrFail($serviceId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $service->update($validated);

        return redirect()->route('admin.spas.services.index', $spa->id_spa)
            ->with('success', 'Service updated successfully!');
    }

    public function destroy($spaId, $serviceId)
    {
        $spa = Spa::findOrFail($spaId);
        $service = SpaService::where('spa_id', $spaId)->findOrFail($serviceId);
        $service->delete();

        return redirect()->route('admin.spas.services.index', $spa->id_spa)
            ->with('success', 'Service deleted successfully!');
    }
}