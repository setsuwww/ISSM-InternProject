<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:150'
        ]);

        Location::create([
            'location' => $request->location,
        ]);

        return redirect()->route('admin.management.index', ['tab' => 'location']);
    }

    public function update(Location $location, Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:150'
        ]);

        $location->update([
            'location' => $request->location,
        ]);

        return redirect()->route('admin.management.index', ['tab' => 'location']);
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->validate([
            'locations' => 'required|array',
            'locations.*.location' => 'required|string|max:150',
        ]);

        foreach ($data['locations'] as $id => $row) {
            Location::where('id', $id)
                ->where('is_active', true)
                ->update([
                    'location' => $row['location'],
                ]);
        }

        return redirect()->route('admin.management.index', ['tab' => 'location']);
    }

    public function destroy(Location $location)
    {
        $location->update(['is_active' => false]);

        return redirect()->route('admin.management.index', ['tab' => 'location']);
    }
}
