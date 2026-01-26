<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;

class Fungsi extends Model
{
    protected $table = 'fungsis';

    protected $fillable = ['fungsi', 'is_active'];

    public function jabatans()
    {
        return $this->hasMany(Jabatan::class);
    }
}
