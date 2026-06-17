<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $partners   = Partner::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $events     = Event::with('category')->latest()->get();

        return view('welcome', compact('partners', 'categories', 'events'));
    }

    public function category($slug)
    {
        $categories     = Category::orderBy('name')->get();
        $partners       = Partner::orderBy('name')->get();
        $activeCategory = Category::where('slug', $slug)->firstOrFail();
        $events         = Event::with('category')
                                ->where('category_id', $activeCategory->id)
                                ->latest()
                                ->get();

        return view('welcome', compact('partners', 'categories', 'events', 'activeCategory'));
    }

    // Ditambahkan untuk menangani detail event & form checkout tiket
    public function show($id)
    {
        // Mengambil data event berdasarkan ID beserta relasi kategorinya
        $event = Event::with('category')->findOrFail($id);

        // Mengarahkan ke halaman form pemesanan tiket (checkout/create.blade.php)
        return view('checkout.create', compact('event'));
    }
}