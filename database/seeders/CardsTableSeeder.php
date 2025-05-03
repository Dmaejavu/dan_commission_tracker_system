<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cards')->insert([
            ['cardID' => 1, 'banktype' => 'BDO', 'cardtype' => 'Silver'],
            ['cardID' => 2, 'banktype' => 'BDO', 'cardtype' => 'Gold'],
            ['cardID' => 3, 'banktype' => 'BDO', 'cardtype' => 'Platinum'],
            ['cardID' => 4, 'banktype' => 'BPI', 'cardtype' => 'Silver'],
            ['cardID' => 5, 'banktype' => 'BPI', 'cardtype' => 'Gold'],
            ['cardID' => 6, 'banktype' => 'BPI', 'cardtype' => 'Platinum'],
            ['cardID' => 7, 'banktype' => 'CBC', 'cardtype' => 'Silver'],
            ['cardID' => 8, 'banktype' => 'CBC', 'cardtype' => 'Gold'],
            ['cardID' => 9, 'banktype' => 'CBC', 'cardtype' => 'Platinum'],
        ]);
    }
}