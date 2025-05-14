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
            ['cardID' => 1, 'banktype' => 'BDO', 'cardtype' => 'Silver','prices'=>'5000'],
            ['cardID' => 2, 'banktype' => 'BDO', 'cardtype' => 'Gold','prices'=>'10000'],
            ['cardID' => 3, 'banktype' => 'BDO', 'cardtype' => 'Platinum','prices'=>'15000'],
            ['cardID' => 4, 'banktype' => 'BPI', 'cardtype' => 'Silver','prices'=>'4500'],
            ['cardID' => 5, 'banktype' => 'BPI', 'cardtype' => 'Gold','prices'=>'95000'],
            ['cardID' => 6, 'banktype' => 'BPI', 'cardtype' => 'Platinum','prices'=>'14500'],
            ['cardID' => 7, 'banktype' => 'CBC', 'cardtype' => 'Silver','prices'=>'10000'],
            ['cardID' => 8, 'banktype' => 'CBC', 'cardtype' => 'Gold','prices'=>'12000'],
            ['cardID' => 9, 'banktype' => 'CBC', 'cardtype' => 'Platinum','prices'=>'15000'],
        ]);
    }
}