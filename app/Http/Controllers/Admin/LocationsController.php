<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Locations;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {
        $locations = Locations::latest()->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => ['required', 'string', 'max:255', 'unique:locations,location'],
        ]);

        Locations::create([
            'location' => $validated['location'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.locations.index')
            ->with('success', 'Fungsi berhasil ditambahkan');
    }

    public function show(Locations $locations)
    {
        return view('admin.locations.show', compact('locations'));
    }

    public function edit(Locations $locations)
    {
        return view('admin.locations.edit', compact('locations'));
    }

    public function update(Request $request, Locations $locations)
    {
        $validated = $request->validate([
            'location' => ['required', 'string', 'max:255', 'unique:locations,location,' . $locations->id],
            'is_active' => ['required', 'boolean'],
        ]);

        $locations->update($validated);

        return redirect()
            ->route('admin.locations.index')
            ->with('success', 'Fungsi berhasil diperbarui');
    }

    public function destroy(Locations $locations)
    {
        $locations->delete();

        return redirect()
            ->route('admin.locations.index')
            ->with('success', 'Fungsi berhasil dihapus');
    }
}
