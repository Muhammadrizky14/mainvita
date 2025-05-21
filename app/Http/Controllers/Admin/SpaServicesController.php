<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use App\Models\SpaService;
use Illuminate\Http\Request;

class SpaServicesController extends Controller
{
    /**
     * Display a listing of the services for a specific spa.
     */
    public function index($spaId)
    {
        $spa = Spa::findOrFail($spaId);
        $services = SpaService::where('spa_id', $spaId)->get();
        
        return view('admin.spa-services.index', compact('spa', 'services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create($spaId)
    {
        $spa = Spa::findOrFail($spaId);
        return view('admin.spa-services.create', compact('spa'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request, $spaId)
    {
        $spa = Spa::findOrFail($spaId);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['spa_id'] = $spaId;
        $validated['is_active'] = $request->has('is_active');
        
        SpaService::create($validated);
        
        return redirect()->route('admin.spas.services.index', $spaId)
            ->with('success', 'Service added successfully');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($spaId, $serviceId)
    {
        $spa = Spa::findOrFail($spaId);
        $service = SpaService::findOrFail($serviceId);
        
        return view('admin.spa-services.edit', compact('spa', 'service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, $spaId, $serviceId)
    {
        $spa = Spa::findOrFail($spaId);
        $service = SpaService::findOrFail($serviceId);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);
        
        $validated['is_active'] = $request->has('is_active');
        
        $service->update($validated);
        
        return redirect()->route('admin.spas.services.index', $spaId)
            ->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy($spaId, $serviceId)
    {
        $service = SpaService::findOrFail($serviceId);
        $service->delete();
        
        return redirect()->route('admin.spas.services.index', $spaId)
            ->with('success', 'Service deleted successfully');
    }
}
