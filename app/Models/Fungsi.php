<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;

class Fungsi extends Model
{
    protected $table = 'fungsis';

    protected $fillable = [
        'fungsi',
        'is_active',
    ];

    public function fungsis()
    {
        return $this->belongsToMany(Fungsi::class, 'jabatan_fungsi');
    }
}
