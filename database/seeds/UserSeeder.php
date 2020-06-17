<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::create(['name' => 'customer']);   
        $user=User::create([
            'name'=>'customer',
            'email'=>'farid@customer.com',
            'password'=>Hash::make('password'),

         ]);
         $user->assignRole($role);


        $role=Role::create(['name' => 'owner']);   
        $user=User::create([
            'name'=>'owner',
            'email'=>'farid@owner.com',
            'password'=>Hash::make('password'),

         ]);
         $user->assignRole($role);

        $role=Role::create(['name' => 'admin']);   
        $user=User::create([
            'name'=>'admin',
            'email'=>'farid@admin.com',
            'password'=>Hash::make('password'),

         ]);
         $user->assignRole($role);
    }
}
