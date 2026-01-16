<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatans;

class Fungsis extends Model
{
    protected $fillable = [
        'jabatan',
        'is_active',
    ];

    public function jabatans()
    {
        return $this->belongsToMany(Jabatans::class, 'jabatan_fungsi');
    }
}
