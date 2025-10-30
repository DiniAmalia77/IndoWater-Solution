<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access with all permissions',
                'is_system_role' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Technician',
                'slug' => 'technician',
                'description' => 'Field technician for device installation and maintenance',
                'is_system_role' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Customer',
                'slug' => 'customer',
                'description' => 'Regular customer with limited access',
                'is_system_role' => true,
                'is_active' => true,
            ],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(
                ['slug' => $roleData['slug']],
                $roleData
            );
        }

        $this->command->info('✅ Roles created successfully!');
    }
}
