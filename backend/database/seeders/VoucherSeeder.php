<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $vouchers = [
            [
                'code' => 'WELCOME50',
                'name' => 'Welcome Bonus 50%',
                'description' => 'Get 50% discount on your first purchase',
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'max_discount' => 100000,
                'min_purchase' => 50000,
                'usage_limit' => 100,
                'used_count' => 15,
                'valid_from' => Carbon::now()->subDays(30),
                'valid_until' => Carbon::now()->addDays(60),
                'status' => 'active',
            ],
            [
                'code' => 'SAVE100K',
                'name' => 'Save 100.000',
                'description' => 'Fixed discount Rp 100.000',
                'discount_type' => 'fixed',
                'discount_value' => 100000,
                'max_discount' => 100000,
                'min_purchase' => 200000,
                'usage_limit' => 50,
                'used_count' => 8,
                'valid_from' => Carbon::now()->subDays(15),
                'valid_until' => Carbon::now()->addDays(45),
                'status' => 'active',
            ],
            [
                'code' => 'NEWYEAR2025',
                'name' => 'New Year Promo',
                'description' => '25% off for New Year celebration',
                'discount_type' => 'percentage',
                'discount_value' => 25,
                'max_discount' => 75000,
                'min_purchase' => 100000,
                'usage_limit' => null,
                'used_count' => 42,
                'valid_from' => Carbon::now()->subDays(10),
                'valid_until' => Carbon::now()->addDays(20),
                'status' => 'active',
            ],
        ];

        foreach ($vouchers as $voucherData) {
            Voucher::firstOrCreate(
                ['code' => $voucherData['code']],
                $voucherData
            );
        }

        $this->command->info('✅ ' . count($vouchers) . ' vouchers created!');
    }
}
