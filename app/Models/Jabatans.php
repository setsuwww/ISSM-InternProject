<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fungsis;

class Jabatans extends Model
{
    protected $fillable = [
        'jabatan',
        'is_active',
    ];
    public function fungsis()
    {
        return $this->belongsToMany(Fungsis::class, 'jabatan_fungsi');
    }
}
