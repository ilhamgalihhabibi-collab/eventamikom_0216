@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <header class="mb-10">
        <h1 class="text-3xl font-black">Edit Event</h1>
        <p class="text-slate-500 font-medium">Ubah detail acara "{{ $event->title }}"</p>
    </header>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl border border-red-200">
            <p class="font-bold mb-2">Gagal memperbarui, periksa kembali isian Anda:</p>
            <ul class="list-disc pl-5 font-medium text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- PENTING: Untuk proses update --}}
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Judul Event</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Penyelenggara</label>
                    <input type="text" name="organizer" value="{{ old('organizer', $event->organizer) }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="category_id" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal</label>
                        {{-- FIX: Memecah data DATETIME dari database menjadi format YYYY-MM-DD untuk input date --}}
                        <input type="date" name="event_date" value="{{ old('event_date', $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jam</label>
                        {{-- FIX: Memecah data DATETIME dari database menjadi format HH:MM untuk input time --}}
                        <input type="time" name="event_time" value="{{ old('event_time', $event->date ? \Carbon\Carbon::parse($event->date)->format('H:i') : '') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $event->price) }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok Tiket</label>
                    <input type="number" name="stock" value="{{ old('stock', $event->stock) }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Poster Event</label>
                {{-- FIX: Menggunakan jalur asset storage yang benar --}}
                @if($event->poster_path)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $event->poster_path) }}" class="w-32 rounded-lg shadow-sm border" alt="Poster Saat Ini">
                        <p class="text-xs text-slate-400 mt-1">Poster saat ini</p>
                    </div>
                @endif
                <input type="file" name="poster_path" accept="image/*" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-slate-50 outline-none">
                <p class="text-xs text-slate-400 mt-1 italic">*Kosongkan jika tidak ingin mengubah poster</p>
            </div>

            <div class="flex justify-end items-center gap-4 mt-8 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.events.index') }}" class="px-6 py-3 text-slate-500 font-bold hover:bg-slate-100 rounded-xl transition">Batal</a>
                <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection