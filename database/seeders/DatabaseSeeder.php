<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Pasien::factory(35)->create();

        DB::table('dokter')->insert([
            'nama' => 'dr. Vegapunk',
            'sip' => '123456',
        ]);

        DB::table('dokter')->insert([
            'nama' => 'dr. Tony Tony Chopper',
            'sip' => '654321',
        ]);

        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
