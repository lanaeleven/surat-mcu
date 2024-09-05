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
            $table->string('hariHijriyah')->default('0');
            $table->string('bulanHijriyah')->default('0');
            $table->string('tahunHijriyah')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screening', function (Blueprint $table) {
            $table->dropColumn('hariHijriyah');
            $table->dropColumn('bulanHijriyah');
            $table->dropColumn('tahunHijriyah');
        });
    }
};
