<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Winner;
use App\Models\User;
use App\Models\AdSlot;

class WinnerSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $slot = AdSlot::first();

        if ($user && $slot) {
            Winner::create([
                'user_id' => $user->id,
                'ad_slot_id' => $slot->id,
                'amount' => 150.00,
            ]);

            $slot->update(['status' => 'awarded']);
        }
    }
}
