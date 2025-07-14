<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles to be seeded
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'guest'],
        ];

        // Loop through each role and create it in the database
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
