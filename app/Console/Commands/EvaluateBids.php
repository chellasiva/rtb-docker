<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EvaluateBids extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:evaluate-bids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $slots = AdSlot::where('status', 'open')->where('end_time', '<', now())->get();

        foreach ($slots as $slot) {
            $bid = $slot->bids()->orderByDesc('amount')->orderBy('created_at')->first();
            if ($bid) {
                Winner::create([
                    'user_id' => $bid->user_id,
                    'ad_slot_id' => $slot->id,
                    'amount' => $bid->amount,
                ]);
                $slot->update(['status' => 'awarded']);
            } else {
                $slot->update(['status' => 'closed']);
            }
        }

    }
}
