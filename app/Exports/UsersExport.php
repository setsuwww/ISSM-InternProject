<?php

namespace App\Exports;

use App\Models\User;

class UsersExport
{
    public function collection()
    {
        return User::select('name', 'email', 'akses_role', 'created_at')->get();
    }
}
