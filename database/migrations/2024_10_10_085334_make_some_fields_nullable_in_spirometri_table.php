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
        Schema::table('spirometri', function (Blueprint $table) {
            $table->text('diagAwal')->nullable()->change();
            $table->text('hslPemeriksaan')->nullable()->change();
            $table->text('kesimpulan')->nullable()->change();
            $table->text('saran')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spirometri', function (Blueprint $table) {
            $table->text('diagAwal')->nullable(false)->change();
            $table->text('hslPemeriksaan')->nullable(false)->change();
            $table->text('kesimpulan')->nullable(false)->change();
            $table->text('saran')->nullable(false)->change();
        });
    }
};
