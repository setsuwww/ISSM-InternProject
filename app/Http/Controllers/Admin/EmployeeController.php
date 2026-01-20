<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * List employees
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(10);

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store new employee
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits_between:8,12', 'unique:employees,nik'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:employees,email'],
        ]);

        Employee::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee berhasil ditambahkan');
    }

    /**
     * Show detail
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show edit form
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update employee
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'digits_between:8,12',
                Rule::unique('employees', 'nik')->ignore($employee->id),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'is_active' => ['required', 'boolean'],
        ]);

        $employee->update($validated);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee berhasil diperbarui');
    }

    /**
     * Delete employee
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Employee berhasil dihapus');
    }
}
