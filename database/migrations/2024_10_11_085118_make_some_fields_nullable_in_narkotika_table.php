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
        Schema::table('narkotika', function (Blueprint $table) {
            $table->string('noSurat')->nullable()->change();
            $table->string('pekerjaanPasien')->nullable()->change();
            $table->text('hslWawancara')->nullable()->change();
            $table->boolean('coccaine')->nullable()->change();
            $table->boolean('methamphetamine')->nullable()->change();
            $table->boolean('morphin')->nullable()->change();
            $table->boolean('marijuana')->nullable()->change();
            $table->boolean('benzodiazepines')->nullable()->change();
            $table->boolean('amphetamine')->nullable()->change();
            $table->boolean('kesimpulan')->nullable()->change();
            $table->string('keperluanSurat')->nullable()->change();
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
        Schema::table('narkotika', function (Blueprint $table) {
            $table->string('noSurat')->nullable(false)->change();
            $table->string('pekerjaanPasien')->nullable(false)->change();
            $table->text('hslWawancara')->nullable(false)->change();
            $table->boolean('coccaine')->nullable(false)->change();
            $table->boolean('methamphetamine')->nullable(false)->change();
            $table->boolean('morphin')->nullable(false)->change();
            $table->boolean('marijuana')->nullable(false)->change();
            $table->boolean('benzodiazepines')->nullable(false)->change();
            $table->boolean('amphetamine')->nullable(false)->change();
            $table->boolean('kesimpulan')->nullable(false)->change();
            $table->string('keperluanSurat')->nullable(false)->change();
            $table->string('hariHijriyah')->nullable(false)->change();
            $table->string('bulanHijriyah')->nullable(false)->change();
            $table->string('tahunHijriyah')->nullable(false)->change();
        });
    }
};
