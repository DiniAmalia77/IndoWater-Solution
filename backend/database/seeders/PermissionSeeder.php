<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'dashboard.view', 'description' => 'View dashboard page', 'category' => 'dashboard'],
            ['name' => 'View Analytics', 'slug' => 'dashboard.analytics', 'description' => 'View analytics data', 'category' => 'dashboard'],
            
            // Users
            ['name' => 'View Users', 'slug' => 'users.view', 'description' => 'View users list', 'category' => 'users'],
            ['name' => 'Create Users', 'slug' => 'users.create', 'description' => 'Create new users', 'category' => 'users'],
            ['name' => 'Edit Users', 'slug' => 'users.edit', 'description' => 'Edit existing users', 'category' => 'users'],
            ['name' => 'Delete Users', 'slug' => 'users.delete', 'description' => 'Delete users', 'category' => 'users'],
            
            // Customers
            ['name' => 'View Customers', 'slug' => 'customers.view', 'description' => 'View customers list', 'category' => 'customers'],
            ['name' => 'Create Customers', 'slug' => 'customers.create', 'description' => 'Create new customers', 'category' => 'customers'],
            ['name' => 'Edit Customers', 'slug' => 'customers.edit', 'description' => 'Edit existing customers', 'category' => 'customers'],
            ['name' => 'Delete Customers', 'slug' => 'customers.delete', 'description' => 'Delete customers', 'category' => 'customers'],
            
            // Properties
            ['name' => 'View Properties', 'slug' => 'properties.view', 'description' => 'View properties list', 'category' => 'properties'],
            ['name' => 'Create Properties', 'slug' => 'properties.create', 'description' => 'Create new properties', 'category' => 'properties'],
            ['name' => 'Edit Properties', 'slug' => 'properties.edit', 'description' => 'Edit existing properties', 'category' => 'properties'],
            ['name' => 'Delete Properties', 'slug' => 'properties.delete', 'description' => 'Delete properties', 'category' => 'properties'],
            
            // Devices
            ['name' => 'View Devices', 'slug' => 'devices.view', 'description' => 'View devices list', 'category' => 'devices'],
            ['name' => 'Create Devices', 'slug' => 'devices.create', 'description' => 'Create new devices', 'category' => 'devices'],
            ['name' => 'Edit Devices', 'slug' => 'devices.edit', 'description' => 'Edit existing devices', 'category' => 'devices'],
            ['name' => 'Delete Devices', 'slug' => 'devices.delete', 'description' => 'Delete devices', 'category' => 'devices'],
            
            // Water Usage
            ['name' => 'View Water Usage', 'slug' => 'water-usage.view', 'description' => 'View water usage data', 'category' => 'water-usage'],
            ['name' => 'Export Water Usage', 'slug' => 'water-usage.export', 'description' => 'Export water usage reports', 'category' => 'water-usage'],
            
            // Payments
            ['name' => 'View Payments', 'slug' => 'payments.view', 'description' => 'View payments list', 'category' => 'payments'],
            ['name' => 'Process Payments', 'slug' => 'payments.process', 'description' => 'Process payment transactions', 'category' => 'payments'],
            ['name' => 'Refund Payments', 'slug' => 'payments.refund', 'description' => 'Refund payments', 'category' => 'payments'],
            
            // Vouchers
            ['name' => 'View Vouchers', 'slug' => 'vouchers.view', 'description' => 'View vouchers list', 'category' => 'vouchers'],
            ['name' => 'Create Vouchers', 'slug' => 'vouchers.create', 'description' => 'Create new vouchers', 'category' => 'vouchers'],
            ['name' => 'Edit Vouchers', 'slug' => 'vouchers.edit', 'description' => 'Edit existing vouchers', 'category' => 'vouchers'],
            ['name' => 'Delete Vouchers', 'slug' => 'vouchers.delete', 'description' => 'Delete vouchers', 'category' => 'vouchers'],
            
            // Support Tickets
            ['name' => 'View Tickets', 'slug' => 'tickets.view', 'description' => 'View support tickets', 'category' => 'tickets'],
            ['name' => 'Create Tickets', 'slug' => 'tickets.create', 'description' => 'Create new tickets', 'category' => 'tickets'],
            ['name' => 'Assign Tickets', 'slug' => 'tickets.assign', 'description' => 'Assign tickets to technicians', 'category' => 'tickets'],
            ['name' => 'Resolve Tickets', 'slug' => 'tickets.resolve', 'description' => 'Resolve support tickets', 'category' => 'tickets'],
            
            // Roles & Permissions
            ['name' => 'View Roles', 'slug' => 'roles.view', 'description' => 'View roles list', 'category' => 'roles'],
            ['name' => 'Create Roles', 'slug' => 'roles.create', 'description' => 'Create new roles', 'category' => 'roles'],
            ['name' => 'Edit Roles', 'slug' => 'roles.edit', 'description' => 'Edit existing roles', 'category' => 'roles'],
            ['name' => 'Delete Roles', 'slug' => 'roles.delete', 'description' => 'Delete roles', 'category' => 'roles'],
            
            // Work Orders
            ['name' => 'View Work Orders', 'slug' => 'work-orders.view', 'description' => 'View work orders list', 'category' => 'work-orders'],
            ['name' => 'Create Work Orders', 'slug' => 'work-orders.create', 'description' => 'Create new work orders', 'category' => 'work-orders'],
            ['name' => 'Assign Work Orders', 'slug' => 'work-orders.assign', 'description' => 'Assign work orders to technicians', 'category' => 'work-orders'],
            ['name' => 'Complete Work Orders', 'slug' => 'work-orders.complete', 'description' => 'Complete work orders', 'category' => 'work-orders'],
            
            // Reports
            ['name' => 'View Reports', 'slug' => 'reports.view', 'description' => 'View reports', 'category' => 'reports'],
            ['name' => 'Export Reports', 'slug' => 'reports.export', 'description' => 'Export reports', 'category' => 'reports'],
            
            // Settings
            ['name' => 'View Settings', 'slug' => 'settings.view', 'description' => 'View settings', 'category' => 'settings'],
            ['name' => 'Edit Settings', 'slug' => 'settings.edit', 'description' => 'Edit settings', 'category' => 'settings'],
        ];

        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate(
                ['slug' => $permissionData['slug']],
                $permissionData
            );
        }

        $this->command->info('✅ Permissions created successfully!');

        // Assign permissions to roles
        $this->assignPermissionsToRoles();
    }

    private function assignPermissionsToRoles()
    {
        $admin = Role::where('slug', 'admin')->first();
        $technician = Role::where('slug', 'technician')->first();
        $customer = Role::where('slug', 'customer')->first();

        // Admin gets all permissions
        $allPermissions = Permission::all();
        $admin->permissions()->sync($allPermissions->pluck('id'));

        // Technician permissions
        $technicianPermissions = Permission::whereIn('category', [
            'dashboard',
            'customers',
            'properties',
            'devices',
            'work-orders',
            'tickets',
        ])->get();
        $technician->permissions()->sync($technicianPermissions->pluck('id'));

        // Customer permissions
        $customerPermissions = Permission::whereIn('slug', [
            'dashboard.view',
            'water-usage.view',
            'payments.view',
            'tickets.view',
            'tickets.create',
        ])->get();
        $customer->permissions()->sync($customerPermissions->pluck('id'));

        $this->command->info('✅ Permissions assigned to roles!');
    }
}
