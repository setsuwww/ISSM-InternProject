<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:150',
            'fungsi_id' => 'required|exists:fungsis,id'
        ]);

        // Constraint: jabatan hanya bisa 1 kali dipakai
        $exists = Jabatan::where('jabatan', $request->jabatan)
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'jabatan' => 'Jabatan sudah digunakan'
            ]);
        }

        Jabatan::create([
            'jabatan' => $request->jabatan,
            'fungsi_id' => $request->fungsi_id,
        ]);

        return back();
    }

    public function update(Jabatan $jabatan, Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:150'
        ]);

        $jabatan->update([
            'jabatan' => $request->jabatan,
        ]);

        return back();
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->validate([
            'jabatans' => 'required|array',
            'jabatans.*.jabatan' => 'required|string|max:150',
        ]);

        foreach ($data['jabatans'] as $id => $row) {
            Jabatan::where('id', $id)
                ->where('is_active', true)
                ->update([
                    'jabatan' => $row['jabatan'],
                ]);
        }

        return back();
    }

    public function destroy(Jabatan $jabatan)
    {
        $jabatan->update(['is_active' => false]);
        return back();
    }
}
