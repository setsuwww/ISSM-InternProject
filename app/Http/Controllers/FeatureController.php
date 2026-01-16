<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->search) {
            if ($search = $request->search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nik', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            }
        }

        $users = $query->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|digits_between:8,12|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'akses_role' => 'required|in:Admin,Operator,User',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nik' => 'required|digits_between:8,12|unique:users,nik,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'akses_role' => 'required|in:Admin,Operator,User',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->selected_users;

        if ($ids) {
            User::whereIn('id', $ids)->delete();
            return back()->with('success', 'Selected users deleted');
        }

        return back()->with('error', 'No users selected');
    }

    public function exportPdf()
    {
        $users = User::all();
        $pdf = Pdf::loadView('admin.users.pdf', compact('users'));
        return $pdf->download('users.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
