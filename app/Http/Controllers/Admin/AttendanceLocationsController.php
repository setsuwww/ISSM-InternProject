<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceLocation;
use Illuminate\Http\Request;

class AttendanceLocationsController extends Controller
{
    public function index()
    {
        $locations = AttendanceLocation::all();
        return view('admin.attendace-locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.attendace-locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|integer|min:1',
        ]);

        AttendanceLocation::create($request->all());

        return redirect()->route('admin.attendace-locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(AttendanceLocation $location)
    {
        return view('admin.attendace-locations.edit', compact('location'));
    }

    public function update(Request $request, AttendanceLocation $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|integer|min:1',
        ]);

        $location->update($request->all());

        return redirect()->route('admin.attendace-locations.index')->with('success', 'Lokasi berhasil diupdate.');
    }

    public function destroy(AttendanceLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.attendace-locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
