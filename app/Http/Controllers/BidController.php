<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdSlot;
use App\Models\Winner;

class BidController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'ad_slot_id' => 'required|exists:ad_slots,id',
        'amount' => 'required|numeric|min:0',
    ]);

    $slot = AdSlot::find($request->ad_slot_id);

    if ($slot->status !== 'open') {
        return response()->json(['error' => 'Slot is not open for bidding'], 400);
    }

    if ($request->amount < $slot->min_bid_price) {
        return response()->json(['error' => 'Bid too low'], 400);
    }

    // Queue this bid
    dispatch(new \App\Jobs\ProcessBid($request->user(), $slot, $request->amount));

    return response()->json(['message' => 'Bid submitted successfully']);
}

public function index(AdSlot $slot)
{
    return response()->json($slot->bids()->with('user')->get());
}

public function winner(AdSlot $slot)
{
    $winner = \App\Models\Winner::where('ad_slot_id', $slot->id)->first();
    return response()->json($winner);
}

public function myBids(Request $request)
{
    return response()->json($request->user()->bids);
}

}
