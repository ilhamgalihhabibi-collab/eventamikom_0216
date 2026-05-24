<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Temukan Event Seru!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255,255,255,0.7); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <nav class="glass sticky top-8 z-40 mx-4 mt-4 px-6 py-4 rounded-2xl border border-white/20 shadow-lg flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">AH</div>
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">AmikomEventHub</a>
        </div>
        <div class="hidden md:flex gap-8 font-medium items-center">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Jelajahi</a>

            {{-- Dropdown Kategori --}}
            @php
                $navCategories = $categories ?? \App\Models\Category::orderBy('name')->get();
            @endphp

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center gap-1 hover:text-indigo-600 transition">
                    Kategori
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     @click.outside="open = false"
                     class="absolute top-full left-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">

                    <a href="{{ route('home') }}"
                       class="block px-5 py-2.5 text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition
                              {{ !isset($activeCategory) ? 'text-indigo-600 font-bold bg-indigo-50' : 'text-slate-700' }}">
                        🎯 Semua Event
                    </a>
                    <div class="border-t border-slate-100 my-1"></div>

                    @forelse($navCategories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="block px-5 py-2.5 text-sm hover:bg-indigo-50 hover:text-indigo-600 transition
                                  {{ isset($activeCategory) && $activeCategory->slug === $cat->slug ? 'text-indigo-600 font-bold bg-indigo-50' : 'text-slate-700' }}">
                            {{ $cat->name }}
                        </a>
                    @empty
                        <p class="px-5 py-3 text-sm text-slate-400">Belum ada kategori</p>
                    @endforelse
                </div>
            </div>

            <a href="#" class="hover:text-indigo-600 transition">Tentang Kami</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 col-span-2">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">AH</div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-xs text-indigo-300">Platform reservasi tiket event online terbaik untuk mahasiswa dan penyelenggara profesional.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="#events" class="hover:text-white transition">Semua Event</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li>support@eventtiket.com</li>
                    <li>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-indigo-800 text-center text-indigo-400 text-sm">
            &copy; 2024 AmikomEventHub. Built with Laravel & Tailwind CSS.
        </div>
    </footer>
</body>
</html>
