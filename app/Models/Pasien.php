<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $guarded = ['id'];

    public function audiometri(): HasMany {
        return $this->hasMany(Audiometri::class, 'idPasien');
    }

    public function spirometri(): HasMany {
        return $this->hasMany(Spirometri::class, 'idPasien');
    }

    public function vaksinasi(): HasMany {
        return $this->hasMany(Vaksinasi::class, 'idPasien');
    }

    public function gizi(): HasMany {
        return $this->hasMany(Gizi::class, 'idPasien');
    }

    public function medicalReport(): HasMany {
        return $this->hasMany(MedicalReport::class, 'idPasien');
    }

    public function screening(): HasMany {
        return $this->hasMany(Screening::class, 'idPasien');
    }

    public function kesehatanBadan(): HasMany {
        return $this->hasMany(KesehatanBadan::class, 'idPasien');
    }

    public function narkotika(): HasMany {
        return $this->hasMany(Narkotika::class, 'idPasien');
    }

    public function treadmill(): HasMany {
        return $this->hasMany(Treadmill::class, 'idPasien');
    }

    public function gigi(): HasMany {
        return $this->hasMany(Gigi::class, 'idPasien');
    }

    public function tuberkulosis(): HasMany {
        return $this->hasMany(Tuberkulosis::class, 'idPasien');
    }

    public function hepatia(): HasMany {
        return $this->hasMany(Hepatia::class, 'idPasien');
    }
}