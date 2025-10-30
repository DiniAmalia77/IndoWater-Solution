<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $adminRole = Role::where('slug', 'admin')->first();
        $technicianRole = Role::where('slug', 'technician')->first();
        $customerRole = Role::where('slug', 'customer')->first();

        // 1. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@indowater.com'],
            [
                'full_name' => 'Admin IndoWater',
                'password' => Hash::make('admin123'),
                'phone' => '+62812345678',
                'address' => 'Jl. Admin Utama No. 1, Jakarta',
                'role' => 'admin',
                'is_active' => true,
            ]
        );
        $admin->roles()->sync([$adminRole->id]);

        // 2. Technician User
        $technician = User::firstOrCreate(
            ['email' => 'technician@indowater.com'],
            [
                'full_name' => 'Budi Teknisi',
                'password' => Hash::make('tech123'),
                'phone' => '+62813456789',
                'address' => 'Jl. Teknisi No. 10, Bandung',
                'role' => 'technician',
                'is_active' => true,
            ]
        );
        $technician->roles()->sync([$technicianRole->id]);

        // 3. Customer User
        $customerUser = User::firstOrCreate(
            ['email' => 'customer@indowater.com'],
            [
                'full_name' => 'Andi Pelanggan',
                'password' => Hash::make('customer123'),
                'phone' => '+62814567890',
                'address' => 'Jl. Pelanggan No. 20, Surabaya',
                'role' => 'customer',
                'is_active' => true,
            ]
        );
        $customerUser->roles()->sync([$customerRole->id]);

        // Create Customer profile for customer user
        Customer::firstOrCreate(
            ['user_id' => $customerUser->id],
            [
                'full_name' => 'Andi Pelanggan',
                'phone' => '+62814567890',
                'email' => 'customer@indowater.com',
                'address' => 'Jl. Pelanggan No. 20, Surabaya',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60111',
                'balance' => 500000.00,
                'status' => 'active',
            ]
        );

        $this->command->info('✅ Demo users created:');
        $this->command->info('   - Admin: admin@indowater.com / admin123');
        $this->command->info('   - Technician: technician@indowater.com / tech123');
        $this->command->info('   - Customer: customer@indowater.com / customer123');
    }
}
