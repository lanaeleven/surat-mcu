<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    protected $guarded = ['id'];

    // public function audiometri(): HasOne {
    //     return $this->hasOne(Audiometri::class, 'idDokter');
    // }

    public function audiometri(): HasMany {
        return $this->hasMany(Audiometri::class, 'idDokter');
    }

    public function spirometri(): HasMany {
        return $this->hasMany(Spirometri::class, 'idDokter');
    }
}
