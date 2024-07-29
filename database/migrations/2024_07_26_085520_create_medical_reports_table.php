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
        Schema::create('medical_report', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('idPasien');
            $table->foreign('idPasien')->references('id')->on('pasien');
            $table->unsignedInteger('idDokter');
            $table->foreign('idDokter')->references('id')->on('dokter');
            $table->string('noSurat');
            $table->date('tanggalPemeriksaan');
            $table->string('tinggiBadan');
            $table->string('denyutNadi');
            $table->string('tekananDarah');
            $table->string('spo2');
            $table->string('beratBadan');
            $table->string('frekuensiNafas');
            $table->string('suhuBadan');
            $table->string('imt');
            $table->text('hslPemeriksaan');
            $table->text('saran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_report');
    }
};
