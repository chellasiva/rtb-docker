<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdSlot;
use Carbon\Carbon;

class AdSlotSeeder extends Seeder
{
    public function run()
    {
        AdSlot::create([
            'name' => 'Banner Top Slot',
            'start_time' => Carbon::now()->addMinutes(1),
            'end_time' => Carbon::now()->addMinutes(10),
            'min_bid_price' => 100.00,
            'status' => 'upcoming',
        ]);

        AdSlot::create([
            'name' => 'Sidebar Ad Slot',
            'start_time' => Carbon::now()->subMinutes(10),
            'end_time' => Carbon::now()->addMinutes(5),
            'min_bid_price' => 50.00,
            'status' => 'open',
        ]);
    }
}

