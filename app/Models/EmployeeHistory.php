<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    use HasFactory;

    protected $table = 'employee_history';

    protected $fillable = [
        'employee_nik',
        'roles_id',
        'locations_id',
        'jabatans_id',
        'fungsis_id',
        'tanggal_mulai_efektif',
        'tanggal_akhir_efektif',
        'current_flag',
    ];

    protected $casts = [
        'current_flag' => 'boolean',
    ];
}
