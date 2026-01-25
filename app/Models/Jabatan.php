<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fungsi;

class Jabatan extends Model
{
    protected $fillable = [
        'jabatan',
        'is_active',
    ];

    public function fungsis()
    {
        return $this->belongsToMany(Fungsi::class, 'jabatan_fungsi');
    }
}
