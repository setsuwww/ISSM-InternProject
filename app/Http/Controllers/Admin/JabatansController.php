<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatans;
use Illuminate\Http\Request;

class JabatansController extends Controller
{
    public function index()
    {
        $jabatans = Jabatans::latest()->paginate(10);
        return view('admin.jabatans.index', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.jabatans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => ['required', 'string', 'max:255', 'unique:jabatans,jabatan'],
        ]);

        Jabatans::create([
            'jabatan' => $validated['jabatan'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.jabatans.index')
            ->with('success', 'Fungsi berhasil ditambahkan');
    }

    public function show(Jabatans $jabatans)
    {
        return view('admin.jabatans.show', compact('jabatans'));
    }

    public function edit(Jabatans $jabatans)
    {
        return view('admin.jabatans.edit', compact('jabatans'));
    }

    public function update(Request $request, Jabatans $jabatans)
    {
        $validated = $request->validate([
            'jabatan' => ['required', 'string', 'max:255', 'unique:jabatans,jabatan,' . $jabatans->id],
            'is_active' => ['required', 'boolean'],
        ]);

        $jabatans->update($validated);

        return redirect()
            ->route('admin.jabatans.index')
            ->with('success', 'Fungsi berhasil diperbarui');
    }

    public function destroy(Jabatans $jabatans)
    {
        $jabatans->delete();

        return redirect()
            ->route('admin.jabatans.index')
            ->with('success', 'Fungsi berhasil dihapus');
    }
}
