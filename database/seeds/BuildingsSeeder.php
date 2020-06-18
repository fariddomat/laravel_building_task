<?php

use App\Buildings;
use Illuminate\Database\Seeder;

class BuildingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buildings::create([
            'city' =>'homs',
            'town' => 'homs',
            'type' =>'house',
            'price' => 30,
            'approverd'=>true,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'homs',
            'town' => 'kafrram',
            'type' =>'store',
            'price' => 40,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'damas',
            'town' => 'damas',
            'type' =>'villa',
            'price' => 100,
            'approverd'=>true,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'latakia',
            'town' => 'el_zeraa',
            'type' =>'house',
            'price' => 50,
            'approverd'=>true,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'latakia',
            'town' => 'el-Amerkan',
            'type' =>'house',
            'price' => 150,
            'approverd'=>true,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'tartus',
            'town' => 'tartus',
            'type' =>'villa',
            'price' => 40,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'aleppo',
            'town' => 'aleppo',
            'type' =>'house',
            'price' => 70,
            'approverd'=>true,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);

        Buildings::create([
            'city' =>'aleppo',
            'town' => 'shikh maksoud',
            'type' =>'house',
            'price' => 80,
            'approverd'=>true,
            'description' => 'description for the house to view it',
            'user_id' => '2'
        ]);


    }
}
