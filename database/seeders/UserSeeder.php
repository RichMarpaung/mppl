<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role_id' => 1, // Assuming 'admin' role has ID 1
                'name' => 'Admin User',
                'nik' => '1234567890',
                'phone'=>'0811',
                'address'=>'Jakarta',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'role_id' => 2, // Assuming 'userbiasa' role has ID 2
                'name' => 'Regular User',
                'nik' => '0987654321',
                'phone'=>'0812',
                'address'=>'Jakarta',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        User::insert([

            [
                'role_id' => 1, // Assuming 'userbiasa' role has ID 2
                'name' => 'Rich Marpaung',
                'nik' => '898989',
                'phone'=>'083199554399',
                'address'=>'Jl.Gereja Porsea',
                'email' => 'ronamarpaung06@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
