<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'organizer'   => 'required|string|max:255',
            'event_date'  => 'required|date',
            'event_time'  => 'required',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:1',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $storeData = [
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'organizer'   => $request->organizer,
            'location'    => $request->location,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'event_date'  => $request->event_date,
            'event_time'  => $request->event_time,
            'poster_path' => null
        ];

        if ($request->hasFile('poster_path')) {
            $path = $request->file('poster_path')->store('posters', 'public');
            $storeData['poster_path'] = $path;
        }

        Event::create($storeData);

        return redirect()->route('admin.events.index')->with('success', 'Event baru berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'organizer'   => 'required|string|max:255',
            'event_date'  => 'required|date',
            'event_time'  => 'required',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:1',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $updateData = [
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'organizer'   => $request->organizer,
            'location'    => $request->location,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'event_date'  => $request->event_date,
            'event_time'  => $request->event_time,
        ];

        if ($request->hasFile('poster_path')) {
            if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $path = $request->file('poster_path')->store('posters', 'public');
            $updateData['poster_path'] = $path;
        }

        $event->update($updateData);

        return redirect()->route('admin.events.index')->with('success', 'Data Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}