<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            PropertySeeder::class,
            DeviceSeeder::class,
            VoucherSeeder::class,
            WaterConservationTipSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('✅ Database seeding completed!');
        $this->command->info('========================================');
        $this->command->info('');
        $this->command->info('Demo Accounts:');
        $this->command->info('  Admin: admin@indowater.com / admin123');
        $this->command->info('  Technician: technician@indowater.com / tech123');
        $this->command->info('  Customer: customer@indowater.com / customer123');
        $this->command->info('');
    }
}
