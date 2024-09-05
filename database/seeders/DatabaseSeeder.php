<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Pasien::factory(35)->create();

        DB::table('dokter')->insert([
            'nama' => "dr. Dewi Febriana Nursari",
            'sip' => "No. 503/095/SIPD/DPMPTSP/III/2023",
        ]);

        DB::table('dokter')->insert([
            'nama' => "dr. Sujudynaraja Mu'minin",
            'sip' => "No. 503/180/DPMPTSP/VII/2023",
        ]);

        DB::table('users')->insert([
            'username' => 'mcu',
            'password' => Hash::make('premier')
        ]);

        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
