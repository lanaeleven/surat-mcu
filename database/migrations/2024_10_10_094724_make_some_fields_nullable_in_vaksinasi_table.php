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
        Schema::table('vaksinasi', function (Blueprint $table) {
            $table->string('noSurat')->nullable()->change();
            $table->string('jenisVaksin')->nullable()->change();
            $table->string('tujuanVaksin')->nullable()->change();
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
        Schema::table('vaksinasi', function (Blueprint $table) {
            $table->string('noSurat')->nullable(false)->change();
            $table->string('jenisVaksin')->nullable(false)->change();
            $table->string('tujuanVaksin')->nullable(false)->change();
            $table->string('hariHijriyah')->nullable(false)->change();
            $table->string('bulanHijriyah')->nullable(false)->change();
            $table->string('tahunHijriyah')->nullable(false)->change();
        });
    }
};
