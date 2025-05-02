<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'userID' => 1,
                'username' => 'admin1',
                'password' => bcrypt('123'),
                'position' => 'Admin',
            ],
            [
                'userID' => 2,
                'username' => 'owner1',
                'password' => bcrypt('123'),
                'position' => 'Owner',
            ],
            [
                'userID' => 3,
                'username' => 'unitmanager1',
                'password' => bcrypt('123'),
                'position' => 'UnitManager',
            ],
        ]);
    }
}
