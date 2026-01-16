<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\AdminUsersLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Schedules;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('shifts'); // Filter keyword (nama/email)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nik', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter role
        if ($request->filled('akses_role')) {
            $query->where('akses_role', $request->akses_role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        $countAdmin = User::where('akses_role', 'admin')->count();
        $countOperator = User::where('akses_role', 'operator')->count();
        $countUser = User::where('akses_role', 'user')->count();

        return view('admin.users.index', compact('users', 'countAdmin', 'countOperator', 'countUser'));

        $users = $query->orderBy('name')
            ->paginate(10)
            ->appends($request->query());

        $shifts = Shift::orderBy('name')->pluck('name');

        if ($request->ajax()) {
            return view('admin.users.table', compact('users'))->render();
        }

        return view('admin.users.index', compact('users', 'shifts'));
    }

    public function exportPdf(Request $request)
    {
        $query = User::with('shifts');

        $role = strtolower($request->get('akses_role', 'all'));
        if ($role !== 'all' && in_array($role, ['admin', 'operator', 'user'])) {
            $query->where('akses_role', $role);
        }

        $shift = strtolower($request->get('shift', 'all'));
        if ($shift !== 'all') {
            $query->whereHas('shifts', function ($q) use ($shift) {
                $q->whereRaw('LOWER(name) = ?', [$shift]);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('name')->get();

        $pdf = Pdf::loadView('admin.users.pdf', compact('users'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('users-' . now()->format('YmdHis') . '.pdf');
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
            'akses_role' => 'required|in:admin,operator,user'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        AdminUsersLog::log(
            'create',
            $user->id,
            $user->name,
            $user->email,
            $user->akses_role,
            null,
            [
                'nik' => $user->nik,
                'name' => $user->name,
                'email' => $user->email,
                'akses_role' => $user->akses_role
            ],
            false,
            "Membuat user baru: {$user->name} ({$user->nik})"
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created.');
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
            'akses_role' => 'required|in:admin,operator,user',
        ]);

        $oldValues = [
            'nik' => $user->nik,
            'name' => $user->name,
            'email' => $user->email,
            'akses_role' => $user->akses_role,
        ];

        $user->nik = $data['nik'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->akses_role = $data['akses_role'];

        $newValues = [
            'nik' => $user->nik,
            'name' => $user->name,
            'email' => $user->email,
            'akses_role' => $user->akses_role,
        ];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
            $newValues['password_changed'] = true;
        }

        $user->save();

        AdminUsersLog::log(
            'update',
            $user->id,
            $user->name,
            $user->email,
            $user->akses_role,
            $oldValues,
            $newValues,
            isset($newValues['password_changed']),
            "Mengubah data user: {$user->name} ({$user->nik})"
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $userName = $user->name;
        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'akses_role' => $user->akses_role
        ];

        $user->delete();

        // Log admin user activity
        AdminUsersLog::log(
            'delete',
            null,
            $userName,
            $userData['email'],
            $userData['akses_role'],
            $userData,
            null,
            false,
            "Menghapus user: {$userName}"
        );

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

}
