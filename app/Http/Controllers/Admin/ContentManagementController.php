<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Jabatan;
use App\Models\Fungsi;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentManagementController extends Controller
{
    public function index()
    {
        return view('admin.management.index', [
            'roles' => Role::orderBy('role')->get(),
            'jabatans' => Jabatan::with('fungsis')->orderBy('jabatan')->get(),
            'fungsis' => Fungsi::orderBy('fungsi')->get(),
            'locations' => Location::orderBy('location')->get(),
            'usedFungsiIds' => DB::table('jabatan_fungsi')->pluck('fungsi_id')->toArray(),
        ]);
    }

    /* ================= ROLE ================= */
    public function storeRole(Request $r)
    {
        $r->validate(['role' => 'required']);
        Role::create(['role' => $r->role]);
        return back();
    }

    public function updateRole(Request $r, Role $role)
    {
        $r->validate(['role' => 'required']);
        $role->update(['role' => $r->role]);
        return back();
    }

    public function destroyRole(Role $role)
    {
        $role->delete();
        return back();
    }

    /* ================= JABATAN ================= */
    public function storeJabatan(Request $r)
    {
        $r->validate(['jabatan' => 'required']);
        Jabatan::create(['jabatan' => $r->jabatan]);
        return back();
    }

    public function updateJabatan(Request $r, Jabatan $jabatan)
    {
        $r->validate(['jabatan' => 'required']);
        $jabatan->update(['jabatan' => $r->jabatan]);
        return back();
    }

    public function destroyJabatan(Jabatan $jabatan)
    {
        DB::table('jabatan_fungsi')->where('jabatan_id', $jabatan->id)->delete();
        $jabatan->delete();
        return back();
    }

    /* ================= FUNGSI ================= */
    public function storeFungsi(Request $r)
    {
        $r->validate(['fungsi' => 'required']);
        Fungsi::create(['fungsi' => $r->fungsi]);
        return back();
    }

    public function updateFungsi(Request $r, Fungsi $fungsi)
    {
        $r->validate(['fungsi' => 'required']);
        $fungsi->update(['fungsi' => $r->fungsi]);
        return back();
    }

    public function destroyFungsi(Fungsi $fungsi)
    {
        DB::table('jabatan_fungsi')->where('fungsi_id', $fungsi->id)->delete();
        $fungsi->delete();
        return back();
    }

    /* ================= LOCATION ================= */
    public function storeLocation(Request $r)
    {
        $r->validate(['location' => 'required']);
        Location::create(['location' => $r->location]);
        return back();
    }

    public function updateLocation(Request $r, Location $location)
    {
        $r->validate(['location' => 'required']);
        $location->update(['location' => $r->location]);
        return back();
    }

    public function destroyLocation(Location $location)
    {
        $location->delete();
        return back();
    }

    /* ================= RELASI ================= */
    public function updateJabatanFungsi(Request $r, Jabatan $jabatan)
    {
        DB::transaction(function () use ($r, $jabatan) {
            DB::table('jabatan_fungsi')->where('jabatan_id', $jabatan->id)->delete();

            foreach ($r->fungsi_ids ?? [] as $fungsiId) {
                DB::table('jabatan_fungsi')->insert([
                    'jabatan_id' => $jabatan->id,
                    'fungsi_id' => $fungsiId,
                ]);
            }
        });

        return back();
    }
}
