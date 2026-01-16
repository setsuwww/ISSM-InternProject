<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JabatanFungsi extends Pivot
{
    protected $table = 'jabatan_fungsi';

    protected $fillable = [
        'jabatan_id',
        'fungsi_id',
    ];

    public function fungsis()
    {
        return $this->belongsToMany(Fungsis::class, 'jabatan_fungsi')
            ->using(JabatanFungsi::class);
    }

    public function jabatans()
    {
        return $this->belongsToMany(Jabatans::class, 'jabatan_fungsi')
            ->using(JabatanFungsi::class);
    }
}
