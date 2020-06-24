<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $user=Admin::create([

        	'name'=>'super admin',
        	'email'=>'super_admin@gmail.com',
        	'password'=>bcrypt('123456'),
        ]);

        // $user->attachRole('super_admin');
    }
}
