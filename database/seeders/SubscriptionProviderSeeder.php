<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SubscriptionProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionProvider::firstOrCreate(['name' => 'Google']);

        SubscriptionProvider::firstOrCreate(['name' => 'Apple']);
    }
}
