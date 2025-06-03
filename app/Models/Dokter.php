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

    public function vaksinasi(): HasMany {
        return $this->hasMany(Vaksinasi::class, 'idDokter');
    }

    public function gizi(): HasMany {
        return $this->hasMany(Gizi::class, 'idDokter');
    }

    public function medicalReport(): HasMany {
        return $this->hasMany(MedicalReport::class, 'idDokter');
    }

    public function screening(): HasMany {
        return $this->hasMany(Screening::class, 'idDokter');
    }

    public function kesehatanBadan(): HasMany {
        return $this->hasMany(KesehatanBadan::class, 'idDokter');
    }

    public function narkotika(): HasMany {
        return $this->hasMany(Narkotika::class, 'idDokter');
    }

    public function treadmill(): HasMany {
        return $this->hasMany(Treadmill::class, 'idDokter');
    }

    public function gigi(): HasMany {
        return $this->hasMany(Gigi::class, 'idDokter');
    }

    public function tuberkulosis(): HasMany {
        return $this->hasMany(Tuberkulosis::class, 'idDokter');
    }
}
