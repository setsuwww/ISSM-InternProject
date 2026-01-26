<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Location;
use App\Models\Fungsi;
use App\Models\Jabatan;

class ManagementController extends Controller
{
    public function index()
    {
        return view('admin.management.index', [
            'roles' => Role::where('is_active', true)->get(),
            'locations' => Location::where('is_active', true)->get(),
            'fungsis' => Fungsi::where('is_active', true)->with('jabatans')->get(),
            'jabatans' => Jabatan::where('is_active', true)->with('fungsi')->get(),
        ]);
    }
}
