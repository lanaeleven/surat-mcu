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
        Schema::table('treadmill', function (Blueprint $table) {
            $table->text('hslPemeriksaan')->nullable()->change();
            $table->text('kesimpulan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treadmill', function (Blueprint $table) {
            $table->text('hslPemeriksaan')->nullable(false)->change();
            $table->text('kesimpulan')->nullable(false)->change();
        });
    }
};