<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeHistory;
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
        return view('admin.employee-history.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_nik' => 'required|string|max:255',
            'roles_id' => 'required|string|max:255',
            'locations_id' => 'required|string|max:255',
            'jabatans_id' => 'required|string|max:255',
            'fungsis_id' => 'required|string|max:255',
            'tanggal_mulai_efektif' => 'required|string|max:25',
            'tanggal_akhir_efektif' => 'nullable|string|max:25',
            'current_flag' => 'required|boolean',
        ]);

        EmployeeHistory::create($validated);

        return redirect()
            ->route('admin.employee-history.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(EmployeeHistory $employeePosition)
    {
        return view('admin.employee-history.show', compact('employeePosition'));
    }

    public function edit(EmployeeHistory $employeePosition)
    {
        return view('admin.employee-history.edit', compact('employeePosition'));
    }

    public function update(Request $request, EmployeeHistory $employeePosition)
    {
        $validated = $request->validate([
            'employee_nik' => 'required|string|max:255',
            'roles_id' => 'required|string|max:255',
            'locations_id' => 'required|string|max:255',
            'jabatans_id' => 'required|string|max:255',
            'fungsis_id' => 'required|string|max:255',
            'tanggal_mulai_efektif' => 'required|string|max:25',
            'tanggal_akhir_efektif' => 'nullable|string|max:25',
            'current_flag' => 'required|boolean',
        ]);

        $employeePosition->update($validated);

        return redirect()
            ->route('admin.employee-history.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(EmployeeHistory $employeePosition)
    {
        $employeePosition->delete();

        return redirect()
            ->route('admin.employee-history.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
