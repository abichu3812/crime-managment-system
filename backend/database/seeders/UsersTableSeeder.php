<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' => 'admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
            
                'department' => '',
                'role' => 'admin',
                'status' => 'active',
            ],

        
            [
                'name' => 'inspector',
                'username' => 'inspector',
                'email' => 'inspector@gmail.com',
                'password' => Hash::make('111'),
        

                'department' => '',
                'role' => 'inspector',
                'status' => 'active',
            ],

    
            [
                'name' => 'investigator',
                'username' => 'investigator',
                'email' => 'investigator@gmail.com',
                'password' => Hash::make('111'),
            

                'department' => '',
                'role' => 'investigator',
                'status' => 'active',
            ],

        
            [
                'name' => 'commander',
                'username' => 'commander',
                'email' => 'commander@gmail.com',
                'password' => Hash::make('111'),
            
                'department' => '',
                'role' => 'commander',
                'status' => 'active',
            ],

            
            [
                'name' => 'register_office',
                'username' => 'register_office',
                'email' => 'register_office@gmail.com',
                'password' => Hash::make('111'),
            
                'department' => '',
                'role' => 'register_office',
                'status' => 'active',
            ],
        ]);

        //
    }
}