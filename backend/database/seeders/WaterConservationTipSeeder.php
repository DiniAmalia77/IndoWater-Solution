<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WaterConservationTip;

class WaterConservationTipSeeder extends Seeder
{
    public function run(): void
    {
        $tips = [
            [
                'title' => 'Fix Leaking Taps',
                'content' => 'A dripping tap can waste up to 15 liters of water per day. Check and fix leaking taps regularly to save water and money.',
                'category' => 'maintenance',
                'estimated_savings' => 450,
                'difficulty_level' => 'easy',
                'is_active' => true,
            ],
            [
                'title' => 'Shorter Showers',
                'content' => 'Reduce shower time by just 2 minutes to save approximately 10 liters of water per shower.',
                'category' => 'daily_habits',
                'estimated_savings' => 300,
                'difficulty_level' => 'easy',
                'is_active' => true,
            ],
            [
                'title' => 'Use Bucket While Bathing',
                'content' => 'Use a bucket instead of running water continuously while bathing. This can save up to 50 liters per bath.',
                'category' => 'daily_habits',
                'estimated_savings' => 1500,
                'difficulty_level' => 'easy',
                'is_active' => true,
            ],
            [
                'title' => 'Collect AC Water',
                'content' => 'Collect water from air conditioner drainage and use it for plants or cleaning.',
                'category' => 'recycling',
                'estimated_savings' => 200,
                'difficulty_level' => 'medium',
                'is_active' => true,
            ],
            [
                'title' => 'Install Water-Efficient Showerheads',
                'content' => 'Replace old showerheads with water-efficient models to reduce water usage by up to 40%.',
                'category' => 'technology',
                'estimated_savings' => 800,
                'difficulty_level' => 'medium',
                'is_active' => true,
            ],
        ];

        foreach ($tips as $tipData) {
            WaterConservationTip::firstOrCreate(
                ['title' => $tipData['title']],
                $tipData
            );
        }

        $this->command->info('✅ ' . count($tips) . ' conservation tips created!');
    }
}
