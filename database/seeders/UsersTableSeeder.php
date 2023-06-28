<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), // password
                'remember_token' => Str::random(10),
                'role' => 'admin'
            ],
            [
                'name' => 'employee',
                'email' => 'employee@employee.com',
                'email_verified_at' => now(),
                'password' => bcrypt('employee123'), // password
                'remember_token' => Str::random(10),
                'role' => 'employee'
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'password' => bcrypt('user123'), // password
                'remember_token' => Str::random(10),
                'role' => 'customer'
            ],
            [
                'name' => 'customer',
                'email' => 'customer@customer.com',
                'email_verified_at' => now(),
                'password' => bcrypt('customer123'), // password
                'remember_token' => Str::random(10),
                'role' => 'customer'
            ]
        ]);
    }
}
