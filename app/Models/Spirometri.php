<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spirometri extends Model
{
    use HasFactory;
    protected $table = 'spirometri';
    protected $guarded = ['id'];

    public function pasien(): BelongsTo {
        return $this->belongsTo(Pasien::class, 'idPasien');
    }

    public function dokter(): BelongsTo {
        return $this->belongsTo(Dokter::class, 'idDokter');
    }
}
