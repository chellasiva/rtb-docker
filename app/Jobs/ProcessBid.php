<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Bid;

class ProcessBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user, $slot, $amount;

    public function __construct($user, $slot, $amount)
    {
        $this->user = $user;
        $this->slot = $slot;
        $this->amount = $amount;
    }

    public function handle()
    {
        Bid::create([
            'user_id' => $this->user->id,
            'ad_slot_id' => $this->slot->id,
            'amount' => $this->amount,
        ]);
    }

}
