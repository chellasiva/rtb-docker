<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'min_bid_price',
        'status',
    ];

    public function bids()
    {
        return $this->hasMany(\App\Models\Bid::class);
    }
}
