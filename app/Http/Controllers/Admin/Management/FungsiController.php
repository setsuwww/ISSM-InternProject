<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\Fungsi;
use Illuminate\Http\Request;

class FungsiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fungsi' => 'required|string|max:150'
        ]);

        Fungsi::create([
            'fungsi' => $request->fungsi,
        ]);

        return back();
    }

    public function update(Fungsi $fungsi, Request $request)
    {
        $request->validate([
            'fungsi' => 'required|string|max:150'
        ]);

        $fungsi->update([
            'fungsi' => $request->fungsi,
        ]);

        return back();
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->validate([
            'fungsis' => 'required|array',
            'fungsis.*.fungsi' => 'required|string|max:150',
        ]);

        foreach ($data['fungsis'] as $id => $row) {
            Fungsi::where('id', $id)
                ->where('is_active', true)
                ->update([
                    'fungsi' => $row['fungsi'],
                ]);
        }

        return back();
    }

    public function destroy(Fungsi $fungsi)
    {
        // nonaktifkan semua jabatan dibawahnya
        $fungsi->jabatans()->update(['is_active' => false]);

        $fungsi->update(['is_active' => false]);

        return back();
    }
}
