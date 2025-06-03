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
        Schema::create('tuberkulosis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('idPasien');
            $table->foreign('idPasien')->references('id')->on('pasien');
            $table->unsignedInteger('idDokter');
            $table->foreign('idDokter')->references('id')->on('dokter');
            $table->string('hariHijriyah')->default('0')->nullable();
            $table->string('bulanHijriyah')->default('0')->nullable();
            $table->string('tahunHijriyah')->default('0')->nullable();
            $table->string('noSurat')->nullable();
            $table->date('tanggalPemeriksaan')->nullable();
            $table->string('pekerjaanPasien')->nullable();
            $table->string('keperluanSurat')->nullable();
            $table->boolean('isThorax')->nullable();
            $table->text('keteranganThorax')->nullable();
            $table->boolean('isSputum')->nullable();
            $table->boolean('isTbc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuberkulosis');
    }
};
