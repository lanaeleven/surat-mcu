<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tuberkulosis extends Model
{
    use HasFactory;
    protected $table = 'tuberkulosis';
    protected $guarded = ['id'];

    public function pasien(): BelongsTo {
        return $this->belongsTo(Pasien::class, 'idPasien');
    }

    public function dokter(): BelongsTo {
        return $this->belongsTo(Dokter::class, 'idDokter');
    }
}
