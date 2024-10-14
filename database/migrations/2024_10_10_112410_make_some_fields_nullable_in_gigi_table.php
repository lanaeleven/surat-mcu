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
        Schema::table('gigi', function (Blueprint $table) {
            $table->boolean('karangAtas')->nullable()->change();
            $table->boolean('karangBawah')->nullable()->change();
            $table->string('decay')->nullable()->change();
            $table->string('missing')->nullable()->change();
            $table->string('filling')->nullable()->change();
            $table->string('sisaAkar')->nullable()->change();
            $table->text('jaringanLunak')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gigi', function (Blueprint $table) {
            $table->boolean('karangAtas')->nullable(false)->change();
            $table->boolean('karangBawah')->nullable(false)->change();
            $table->string('decay')->nullable(false)->change();
            $table->string('missing')->nullable(false)->change();
            $table->string('filling')->nullable(false)->change();
            $table->string('sisaAkar')->nullable(false)->change();
            $table->text('jaringanLunak')->nullable(false)->change();
        });
    }
};
