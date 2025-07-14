<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('pastibisa'),
        ]);
        $superAdminRole = Role::firstOrCreate(['name' => 'admin']);


        $adminUser = User::where('username', 'admin')->first();
        if ($adminUser) {
            $adminUser->assignRole($superAdminRole);
        }
    }
}
