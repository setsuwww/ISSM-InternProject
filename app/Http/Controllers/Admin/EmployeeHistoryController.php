<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeHistory;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Location;
use App\Models\Jabatans;
use App\Models\Fungsi;

use Illuminate\Http\Request;

class EmployeeHistoryController extends Controller
{
    public function index()
    {
        $items = EmployeeHistory::latest()->paginate(10);
        return view('admin.employee-history.index', compact('items'));
    }

    public function create()
    {
        return view('admin.employee-history.create', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'role_id' => 'required|exists:roles,id',
            'location_id' => 'required|exists:locations,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'fungsi_id' => 'required|exists:fungsis,id',
            'tanggal_mulai_efektif' => 'required|date',
            'tanggal_akhir_efektif' => 'nullable|date',
            'current_flag' => 'boolean',
        ]);

        EmployeeHistory::create($validated);

        return redirect()
            ->route('admin.employee-history.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(EmployeeHistory $employeeHistory)
    {
        return view('admin.employee-history.show', compact('employeeHistory'));
    }

    public function edit(EmployeeHistory $employeeHistory)
    {
        return view(
            'admin.employee-history.form',
            array_merge(
                $this->formData(),
                compact('employeeHistory')
            )
        );
    }

    public function update(Request $request, EmployeeHistory $employeeHistory)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'role_id' => 'required|exists:roles,id',
            'location_id' => 'required|exists:locations,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'fungsi_id' => 'required|exists:fungsis,id',
            'tanggal_mulai_efektif' => 'required|date',
            'tanggal_akhir_efektif' => 'nullable|date',
            'current_flag' => 'boolean',
        ]);

        $employeeHistory->update($validated);

        return redirect()
            ->route('admin.employee-history.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(EmployeeHistory $employeeHistory)
    {
        $employeeHistory->delete();

        return redirect()
            ->route('admin.employee-history.index')
            ->with('success', 'Data berhasil dihapus');
    }

    private function formData(): array
    {
        return [
            'employees' => Employee::select('id', 'nik', 'nama')->get(),
            'roles' => Roles::select('id', 'role')->get(),
            'locations' => Locations::select('id', 'location')->get(),
            'jabatans' => Jabatans::select('id', 'jabatan')->get(),
            'fungsis' => Fungsis::select('id', 'fungsi')->get(),
        ];
    }
}
