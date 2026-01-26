<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fungsi;

class Jabatan extends Model
{
    protected $fillable = ['jabatan', 'fungsi_id', 'is_active',];

    public function fungsi()
    {
        return $this->belongsTo(Fungsi::class);
    }
}
