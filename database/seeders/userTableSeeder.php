<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the users table before inserting new data
        DB::table('users')->truncate();

        // Insert a user record
        DB::table('users')->insert([
            'id'            => '1',
            'employee_id'   => '00000001',
            'name'          => 'admin',
            'department_id' => '1',
            'nrc_number'    => '7/kakana(N)110538',
            'email'         => 'admin@gmail.com',
            'status'        => '1',
            'password'      => bcrypt('password'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
