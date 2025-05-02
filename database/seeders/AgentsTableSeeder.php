<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agents')->insert([
            [
                'agentID' => 1,
                'agentname' => 'Paul Oborskie',
                'comrate' => 0.20,
                'area' => 'Davao',
            ],
            [
                'agentID' => 2,
                'agentname' => 'Dan Abdul Ajaym',
                'comrate' => 0.20,
                'area' => 'Cotabato',
            ],
            [
                'agentID' => 3,
                'agentname' => 'Wiley Da Fred',
                'comrate' => 0.20,
                'area' => 'Mati',
            ],
            [
                'agentID' => 4,
                'agentname' => 'Skibidi Jose',
                'comrate' => 0.20,
                'area' => 'Samal',
            ],
        ]);
    }
}