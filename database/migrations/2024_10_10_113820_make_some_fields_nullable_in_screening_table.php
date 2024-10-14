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
        Schema::table('screening', function (Blueprint $table) {
            $table->string('noSurat')->nullable()->change();
            $table->string('dokterSpesialis')->nullable()->change();
            $table->string('jenisScreening')->nullable()->change();
            $table->text('hslPemeriksaan')->nullable()->change();
            $table->string('statusKesehatan')->nullable()->change();
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
        Schema::table('screening', function (Blueprint $table) {
            $table->string('noSurat')->nullable(false)->change();
            $table->string('dokterSpesialis')->nullable(false)->change();
            $table->string('jenisScreening')->nullable(false)->change();
            $table->text('hslPemeriksaan')->nullable(false)->change();
            $table->string('statusKesehatan')->nullable(false)->change();
            $table->string('hariHijriyah')->nullable(false)->change();
            $table->string('bulanHijriyah')->nullable(false)->change();
            $table->string('tahunHijriyah')->nullable(false)->change();
        });
    }
};
