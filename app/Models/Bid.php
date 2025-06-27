<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_slot_id',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function adSlot()
    {
        return $this->belongsTo(\App\Models\AdSlot::class);
    }
}
