<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('screening', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('idPasien');
            $table->foreign('idPasien')->references('id')->on('pasien');
            $table->unsignedInteger('idDokter');
            $table->foreign('idDokter')->references('id')->on('dokter');
            $table->string('noSurat');
            $table->date('tanggalPemeriksaan');
            $table->string('dokterSpesialis');
            $table->string('jenisScreening');
            $table->text('hslPemeriksaan');
            $table->string('statusKesehatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screening');
    }
};
