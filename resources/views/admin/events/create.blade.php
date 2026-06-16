@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <header class="mb-10">
        <h1 class="text-3xl font-black">Tambah Event Baru</h1>
        <p class="text-slate-500 font-medium">Buat dan publikasikan acara seru Anda di sini.</p>
    </header>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl border border-red-200">
            <p class="font-bold mb-2">Gagal menyimpan, periksa kembali isian Anda:</p>
            <ul class="list-disc pl-5 font-medium text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Judul Event</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Penyelenggara (Organizer)</label>
                    <input type="text" name="organizer" value="{{ old('organizer') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <select name="category_id" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal</label>
                        <input type="date" name="event_date" value="{{ old('event_date') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jam</label>
                        <input type="time" name="event_time" value="{{ old('event_time') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga</label>
                    <input type="number" name="price" value="{{ old('price') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok Tiket</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-2">Upload Poster</label>
                <input type="file" name="poster_path" accept="image/*" class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-slate-50 outline-none">
            </div>

            <div class="flex justify-end items-center gap-4 mt-8 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.events.index') }}" class="px-6 py-3 text-slate-500 font-bold hover:bg-slate-100 rounded-xl transition">Batal</a>
                <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition">
                    Simpan Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection