<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::latest()->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,role'],
        ]);

        Roles::create([
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role berhasil ditambahkan');
    }

    public function show(Roles $roles)
    {
        return view('admin.roles.show', compact('roles'));
    }

    public function edit(Roles $roles)
    {
        return view('admin.roles.edit', compact('roles'));
    }

    public function update(Request $request, Roles $roles)
    {
        $validated = $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,role,' . $roles->id],
            'is_active' => ['required', 'boolean'],
        ]);

        $roles->update($validated);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role berhasil diperbarui');
    }

    public function destroy(Roles $roles)
    {
        $roles->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Role berhasil dihapus');
    }
}
