<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'password'=>'$2y$12$pYjvbsl1IgO9SJgK9JwBFec1pCmetgBl9CbwmOB3/I/hA1lhXCn3W',
            'user_token'=>'1b5f51d9-13d4-4918-8b52-e64e2c760d3b',
            'role'=>'1',
            'email'=>'baonguyen212002@gmail.com',
        ]);
    }
}
