<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Membuka proteksi agar semua field (termasuk qty, status, snap_token) bisa disimpan
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}