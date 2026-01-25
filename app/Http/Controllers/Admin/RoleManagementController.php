<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Location;
use App\Models\Jabatans;
use App\Models\Fungsi;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index()
    {
        return view('admin.role-management.index', [
            'roles' => Roles::orderBy('role')->get(),
            'locations' => Locations::orderBy('location')->get(),
            'jabatans' => Jabatans::with('fungsis')->orderBy('jabatan')->get(),
            'fungsis' => Fungsis::whereNull('jabatan_id')->orderBy('fungsi')->get(),
        ]);
    }

    /* ===== ROLE ===== */
    public function storeRoles(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:100|unique:roles,role',
        ]);

        Roles::create([
            'role' => $request->role,
        ]);

        return back();
    }

    public function updateRoles(Request $request, Roles $role)
    {
        $request->validate([
            'role' => 'required|string|max:100|unique:roles,role,' . $role->id,
        ]);

        $role->update(['role' => $request->role]);
        return back();
    }

    public function destroyRoles(Roles $role)
    {
        $role->delete();
        return back();
    }

    /* ===== LOCATION ===== */
    public function storeLocations(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:100|unique:locations,location',
        ]);

        Locations::create(['location' => $request->location]);
        return back();
    }

    public function updateLocations(Request $request, Locations $location)
    {
        $request->validate([
            'location' => 'required|string|max:100|unique:locations,location,' . $location->id,
        ]);

        $location->update(['location' => $request->location]);
        return back();
    }

    public function destroyLocations(Locations $location)
    {
        $location->delete();
        return back();
    }

    /* ===== JABATAN ===== */
    public function storeJabatans(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:100|unique:jabatans,jabatan',
        ]);

        Jabatans::create(['jabatan' => $request->jabatan]);
        return back();
    }

    public function updateJabatans(Request $request, Jabatans $jabatan)
    {
        $request->validate([
            'jabatan' => 'required|string|max:100|unique:jabatans,jabatan,' . $jabatan->id,
        ]);

        $jabatan->update(['jabatan' => $request->jabatan]);
        return back();
    }

    public function destroyJabatans(Jabatans $jabatan)
    {
        if ($jabatan->fungsis()->exists()) {
            return back()->withErrors('Masih ada fungsi');
        }

        $jabatan->delete();
        return back();
    }

    /* ===== FUNGSI ===== */
    public function storeFungsis(Request $request)
    {
        $request->validate([
            'fungsi' => 'required|string|max:100|unique:fungsis,fungsi',
        ]);

        Fungsis::create(['fungsi' => $request->fungsi]);
        return back();
    }

    public function destroyFungsis(Fungsis $fungsi)
    {
        if ($fungsi->jabatan_id) {
            return back()->withErrors('Masih terpakai');
        }

        $fungsi->delete();
        return back();
    }

    /* ===== RELASI ===== */
    public function attachFungsis(Request $request, Jabatans $jabatan)
    {
        $request->validate([
            'fungsi_id' => 'required|exists:fungsis,id',
        ]);

        if ($jabatan->fungsis()->count() >= 10) {
            return back()->withErrors('Max 10 fungsi');
        }

        $fungsi = Fungsis::find($request->fungsi_id);

        if ($fungsi->jabatan_id) {
            return back()->withErrors('Fungsis sudah dipakai');
        }

        $fungsi->update(['jabatan_id' => $jabatan->id]);
        return back();
    }

    public function detachFungsis(Jabatans $jabatan, Fungsis $fungsi)
    {
        if ($fungsi->jabatan_id !== $jabatan->id)
            abort(403);

        $fungsi->update(['jabatan_id' => null]);
        return back();
    }
}
