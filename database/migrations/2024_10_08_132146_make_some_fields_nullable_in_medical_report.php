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
        Schema::table('medical_report', function (Blueprint $table) {
            $table->unsignedInteger('idDokter')->nullable()->change();
            $table->string('noSurat')->nullable()->change();
            $table->date('tanggalPemeriksaan')->nullable()->change();
            $table->string('tinggiBadan')->nullable()->change();
            $table->string('denyutNadi')->nullable()->change();
            $table->string('tekananDarah')->nullable()->change();
            $table->string('spo2')->nullable()->change();
            $table->string('beratBadan')->nullable()->change();
            $table->string('frekuensiNafas')->nullable()->change();
            $table->string('suhuBadan')->nullable()->change();
            $table->string('imt')->nullable()->change();
            $table->text('hslPemeriksaan')->nullable()->change();
            $table->text('saran')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_report', function (Blueprint $table) {
            $table->unsignedInteger('idDokter')->nullable(false)->change();
            $table->string('noSurat')->nullable(false)->change();
            $table->date('tanggalPemeriksaan')->nullable(false)->change();
            $table->string('tinggiBadan')->nullable(false)->change();
            $table->string('denyutNadi')->nullable(false)->change();
            $table->string('tekananDarah')->nullable(false)->change();
            $table->string('spo2')->nullable(false)->change();
            $table->string('beratBadan')->nullable(false)->change();
            $table->string('frekuensiNafas')->nullable(false)->change();
            $table->string('suhuBadan')->nullable(false)->change();
            $table->string('imt')->nullable(false)->change();
            $table->text('hslPemeriksaan')->nullable(false)->change();
            $table->text('saran')->nullable(false)->change();
        });
    }
};
