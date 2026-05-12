<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.events', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'organizer' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'poster_path' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . time();

        if ($request->hasFile('poster_path')) {
            $file = $request->file('poster_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('posters'), $nama_file);
            $data['poster_path'] = $nama_file;
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil disimpan!');
    }

    // INI FUNGSI YANG TADI HILANG/UNDEFINED
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit', compact('event', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'organizer' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'poster_path' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->title != $event->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        if ($request->hasFile('poster_path')) {
            // Hapus poster lama jika ada
            if ($event->poster_path && file_exists(public_path('posters/' . $event->poster_path))) {
                unlink(public_path('posters/' . $event->poster_path));
            }

            $file = $request->file('poster_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('posters'), $nama_file);
            $data['poster_path'] = $nama_file;
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}