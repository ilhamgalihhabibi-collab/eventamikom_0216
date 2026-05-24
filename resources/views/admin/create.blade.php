@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Event Baru</h1>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-sm border">
        @csrf

        @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
        <p class="font-bold text-red-600 mb-2">Gagal menyimpan, periksa isian berikut:</p>
        <ul class="list-disc list-inside text-red-500 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block font-bold mb-2">Judul Event</label>
                <input type="text" name="title" class="w-full border p-3 rounded-xl" required>
            </div>
            <div>
                <label class="block font-bold mb-2">Penyelenggara (Organizer)</label>
                <input type="text" name="organizer" class="w-full border p-3 rounded-xl" required>
            </div>
            <div>
                <label class="block font-bold mb-2">Kategori</label>
                <select name="category_id" class="w-full border p-3 rounded-xl" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block font-bold mb-2">Tanggal</label>
                    <input type="date" name="event_date" class="w-full border p-3 rounded-xl" required>
                </div>
                <div>
                    <label class="block font-bold mb-2">Jam</label>
                    <input type="time" name="event_time" class="w-full border p-3 rounded-xl" required>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-bold mb-2">Lokasi</label>
            <input type="text" name="location" class="w-full border p-3 rounded-xl" required>
        </div>

        <div class="mb-6">
            <label class="block font-bold mb-2">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border p-3 rounded-xl" required></textarea>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block font-bold mb-2">Harga</label>
                <input type="number" name="price" class="w-full border p-3 rounded-xl" required>
            </div>
            <div>
                <label class="block font-bold mb-2">Stok Tiket</label>
                <input type="number" name="stock" class="w-full border p-3 rounded-xl" required>
            </div>
        </div>

        <div class="mb-8">
            <label class="block font-bold mb-2">Upload Poster</label>
            <input type="file" name="poster_path" class="w-full border p-3 rounded-xl">
        </div>

        <div class="flex justify-end gap-4">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold">Simpan Event</button>
        </div>
    </form>
</div>
@endsection