<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customerRole = Role::where('slug', 'customer')->first();

        $customers = [
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.n@example.com',
                'phone' => '+62815111222',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'postal_code' => '10110',
                'balance' => 750000,
            ],
            [
                'name' => 'Ahmad Subandi',
                'email' => 'ahmad.s@example.com',
                'phone' => '+62815222333',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'postal_code' => '12190',
                'balance' => 500000,
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.l@example.com',
                'phone' => '+62815333444',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40111',
                'balance' => 600000,
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi.h@example.com',
                'phone' => '+62815444555',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60241',
                'balance' => 450000,
            ],
            [
                'name' => 'Linda Kusuma',
                'email' => 'linda.k@example.com',
                'phone' => '+62815555666',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'postal_code' => '50132',
                'balance' => 800000,
            ],
        ];

        foreach ($customers as $customerData) {
            // Create user
            $user = User::firstOrCreate(
                ['email' => $customerData['email']],
                [
                    'full_name' => $customerData['name'],
                    'password' => Hash::make('password123'),
                    'phone' => $customerData['phone'],
                    'address' => 'Jl. Example No. ' . rand(1, 100),
                    'role' => 'customer',
                    'is_active' => true,
                ]
            );
            $user->roles()->sync([$customerRole->id]);

            // Create customer
            Customer::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $customerData['name'],
                    'phone' => $customerData['phone'],
                    'email' => $customerData['email'],
                    'address' => 'Jl. Customer Street No. ' . rand(1, 100),
                    'city' => $customerData['city'],
                    'province' => $customerData['province'],
                    'postal_code' => $customerData['postal_code'],
                    'balance' => $customerData['balance'],
                    'status' => 'active',
                ]
            );
        }

        $this->command->info('✅ ' . count($customers) . ' additional customers created!');
    }
}
