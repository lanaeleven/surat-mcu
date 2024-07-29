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
        Schema::create('gigi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('idPasien');
            $table->foreign('idPasien')->references('id')->on('pasien');
            $table->unsignedInteger('idDokter');
            $table->foreign('idDokter')->references('id')->on('dokter');
            $table->date('tanggalPemeriksaan');
            $table->boolean('karangAtas')->default(false);
            $table->boolean('karangBawah')->default(false);
            $table->string('decay');
            $table->string('missing');
            $table->string('filling');
            $table->string('sisaAkar');
            $table->text('jaringanLunak');
            $table->text('lainnya')->nullable();
            $table->text('kesimpulan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gigi');
    }
};
