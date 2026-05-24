<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Request $request)
    {
        $event = Event::with('category')
                    ->where('slug', $request->slug)
                    ->firstOrFail();

        return view('event-detail', compact('event'));
    }

    public function checkout()
    {
        return view('checkout');
    }
}