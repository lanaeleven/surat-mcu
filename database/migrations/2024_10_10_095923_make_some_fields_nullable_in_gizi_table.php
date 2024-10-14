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
        Schema::table('gizi', function (Blueprint $table) {
            $table->string('noSurat')->nullable()->change();
            $table->string('tinggiBadan')->nullable()->change();
            $table->string('denyutNadi')->nullable()->change();
            $table->string('tekananDarah')->nullable()->change();
            $table->string('spo2')->nullable()->change();
            $table->string('beratBadan')->nullable()->change();
            $table->string('frekuensiNafas')->nullable()->change();
            $table->string('suhuBadan')->nullable()->change();
            $table->string('imt')->nullable()->change();
            $table->text('hslBIA')->nullable()->change();
            $table->string('statusGizi')->nullable()->change();
            $table->text('rekomTerapiGizi')->nullable()->change();
            $table->text('saran')->nullable()->change();
            $table->string('hariHijriyah')->nullable()->change();
            $table->string('bulanHijriyah')->nullable()->change();
            $table->string('tahunHijriyah')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gizi', function (Blueprint $table) {
            $table->string('noSurat')->nullable(false)->change();
            $table->string('tinggiBadan')->nullable(false)->change();
            $table->string('denyutNadi')->nullable(false)->change();
            $table->string('tekananDarah')->nullable(false)->change();
            $table->string('spo2')->nullable(false)->change();
            $table->string('beratBadan')->nullable(false)->change();
            $table->string('frekuensiNafas')->nullable(false)->change();
            $table->string('suhuBadan')->nullable(false)->change();
            $table->string('imt')->nullable(false)->change();
            $table->text('hslBIA')->nullable(false)->change();
            $table->string('statusGizi')->nullable(false)->change();
            $table->text('rekomTerapiGizi')->nullable(false)->change();
            $table->text('saran')->nullable(false)->change();
            $table->string('hariHijriyah')->nullable(false)->change();
            $table->string('bulanHijriyah')->nullable(false)->change();
            $table->string('tahunHijriyah')->nullable(false)->change();
        });
    }
};
