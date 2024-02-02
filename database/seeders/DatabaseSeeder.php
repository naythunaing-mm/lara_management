<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(userTableSeeder::class);
        $this->call(siteSettingsTable::class);
        $this->call(permissionTableSeeder::class);
        $this->call(roleTableSeeder::class);
        $this->call(role_has_permissionsTableSeeder::class);
    }
}
