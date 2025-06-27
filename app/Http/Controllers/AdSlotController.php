<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdSlot;

class AdSlotController extends Controller
{

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'min_bid_price' => 'required|numeric|min:0',
        'status' => 'in:upcoming,open,closed,awarded', // optional or override default
    ]);

    $adSlot = AdSlot::create($validated);

    return response()->json([
        'message' => 'Ad slot created successfully',
        'data' => $adSlot
    ], 201);
}

    public function index(Request $request)
{
    $status = $request->query('status');
    $query = AdSlot::query();

    if ($status) {
        $query->where('status', $status);
    }

    return response()->json($query->get());
}

}
