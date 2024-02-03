<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class permissionAndRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'employee']);
        Permission::create(['name' => 'employee_create']);
        Permission::create(['name' => 'employeeList_view']);
        Permission::create(['name' => 'employee_edit']);
        Permission::create(['name' => 'employee_delete']);
        Permission::create(['name' => 'employee_detail']);
        Permission::create(['name' => 'hotelSetting']);
        Permission::create(['name' => 'department']);
        Permission::create(['name' => 'department_create']);
        Permission::create(['name' => 'departmentListing_view']);
        Permission::create(['name' => 'role']);
        Permission::create(['name' => 'role_create']);
        Permission::create(['name' => 'roleListing_view']);
        Permission::create(['name' => 'permission']);
        Permission::create(['name' => 'permission_create']);
        Permission::create(['name' => 'permissionListing_view']);

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        $user = User::create([
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
        $user->assignRole($role);
  
     }
}
