<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->delete();

        // Insert a user record
        DB::table('permissions')->insert([
            'id'            => '1',
            'name'          => 'employee',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '2',
            'name'          => 'employee_create',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '3',
            'name'          => 'employeeList_view',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '4',
            'name'          => 'hotelSetting',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '5',
            'name'          => 'department',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '6',
            'name'          => 'department_create',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '7',
            'name'          => 'departmentListing_view',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '8',
            'name'          => 'role',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '9',
            'name'          => 'role_create',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '10',
            'name'          => 'roleListing_view',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '11',
            'name'          => 'permission',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '12',
            'name'          => 'permission_create',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        DB::table('permissions')->insert([
            'id'            => '13',
            'name'          => 'permissionListing_view',
            'guard_name'    => 'Web',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
