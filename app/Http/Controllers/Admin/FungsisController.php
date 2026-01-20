<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fungsis;
use Illuminate\Http\Request;

class FungsisController extends Controller
{
    public function index()
    {
        $fungsis = Fungsis::latest()->paginate(10);
        return view('admin.fungsis.index', compact('fungsis'));
    }

    public function create()
    {
        return view('admin.fungsis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fungsi' => ['required', 'string', 'max:255', 'unique:fungsis,fungsi'],
        ]);

        Fungsis::create([
            'fungsi' => $validated['fungsi'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.fungsis.index')
            ->with('success', 'Fungsi berhasil ditambahkan');
    }

    public function show(Fungsis $fungsis)
    {
        return view('admin.fungsis.show', compact('fungsis'));
    }

    public function edit(Fungsis $fungsis)
    {
        return view('admin.fungsis.edit', compact('fungsis'));
    }

    public function update(Request $request, Fungsis $fungsis)
    {
        $validated = $request->validate([
            'fungsi' => ['required', 'string', 'max:255', 'unique:fungsis,fungsi,' . $fungsis->id],
            'is_active' => ['required', 'boolean'],
        ]);

        $fungsis->update($validated);

        return redirect()
            ->route('admin.fungsis.index')
            ->with('success', 'Fungsi berhasil diperbarui');
    }

    public function destroy(Fungsis $fungsis)
    {
        $fungsis->delete();

        return redirect()
            ->route('admin.fungsis.index')
            ->with('success', 'Fungsi berhasil dihapus');
    }
}
