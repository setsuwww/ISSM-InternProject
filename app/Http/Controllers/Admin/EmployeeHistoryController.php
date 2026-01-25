<?php

namespace App\Http\Controllers;

use App\Models\EmployeeHistory;
use Illuminate\Http\Request;

class EmployeeHistoryController extends Controller
{
    public function index()
    {
        $items = EmployeeHistory::latest()->paginate(10);
        return view('employee_positions.index', compact('items'));
    }

    public function create()
    {
        return view('employee_positions.create');
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
            ->route('employee-positions.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function show(EmployeeHistory $employeePosition)
    {
        return view('employee_positions.show', compact('employeePosition'));
    }

    public function edit(EmployeeHistory $employeePosition)
    {
        return view('employee_positions.edit', compact('employeePosition'));
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
            ->route('employee-positions.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(EmployeeHistory $employeePosition)
    {
        $employeePosition->delete();

        return redirect()
            ->route('employee-positions.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
