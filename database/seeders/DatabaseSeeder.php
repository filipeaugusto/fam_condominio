<?php

namespace Database\Seeders;

use App\Models\Condominium;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Condominium::factory()->create([
            'name' => 'ED ANGELA LTDA',
            'document' => '22.664.178/0001-70',
            'logo' => '01JYVKGS01KN09D96DA7SXQBSR.webp',
        ]);

        User::factory()->create([
            'condominium_id' => 1,
            'name' => 'Filipe Augusto Magalhães ',
            'email' => 'filipeaugustomagalhaes@gmail.com',
            'password' => Hash::make('real0893'),
        ]);

        $this->call([
            ShieldSeeder::class
        ]);

    }
}
