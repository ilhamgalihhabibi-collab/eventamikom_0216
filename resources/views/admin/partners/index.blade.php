@extends('layouts.admin', ['title' => 'Manajemen Partner'])

@section('content')

{{-- Flash message --}}
@if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Partner</h1>
        <p class="text-slate-500">Kelola mitra pendukung AmikomEventHub.</p>
    </div>
    <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
        class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-sm">
        + Tambah Partner
    </button>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('admin.partners.index') }}" class="mb-4">
    <div class="flex gap-3">
        <input type="text" name="search" value="{{ $search ?? '' }}"
            placeholder="Cari nama partner..."
            class="w-full max-w-sm px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-xl font-semibold hover:bg-indigo-700 transition">
            Cari
        </button>
        @if($search)
            <a href="{{ route('admin.partners.index') }}"
                class="px-4 py-2 bg-slate-100 text-slate-600 text-sm rounded-xl font-semibold hover:bg-slate-200 transition">
                Reset
            </a>
        @endif
    </div>
</form>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-100">
                <th class="p-4 font-semibold text-slate-600 w-16">No</th>
                <th class="p-4 font-semibold text-slate-600">Logo</th>
                <th class="p-4 font-semibold text-slate-600">Nama Partner</th>
                <th class="p-4 font-semibold text-slate-600">Dibuat</th>
                <th class="p-4 font-semibold text-slate-600">Diperbarui</th>
                <th class="p-4 font-semibold text-slate-600 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $index => $partner)
            <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                <td class="p-4 text-slate-500">{{ $index + 1 }}</td>
                <td class="p-4">
                    @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                            class="w-12 h-12 object-contain rounded-lg border border-slate-100 bg-white p-1">
                    @else
                        <div class="w-12 h-12 rounded-lg border border-slate-100 bg-slate-50 flex items-center justify-center text-slate-300 text-xs">
                            No Logo
                        </div>
                    @endif
                </td>
                <td class="p-4 font-medium text-slate-800">{{ $partner->name }}</td>
                <td class="p-4 text-sm text-slate-400">{{ $partner->created_at->format('d M Y') }}</td>
                <td class="p-4 text-sm text-slate-400">{{ $partner->updated_at->format('d M Y') }}</td>
                <td class="p-4 text-right">
                    <button
                        onclick="openEditModal({{ $partner->id }}, '{{ addslashes($partner->name) }}')"
                        class="text-blue-500 hover:text-blue-700 font-medium mr-4">
                        Edit
                    </button>
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                        class="inline" onsubmit="return confirm('Hapus partner ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-slate-400">
                    {{ $search ? 'Tidak ada partner yang cocok dengan pencarian.' : 'Belum ada partner.' }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ====================== MODAL TAMBAH ====================== --}}
<div id="modal-create" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-slate-800">Tambah Partner</h2>
            <button onclick="document.getElementById('modal-create').classList.add('hidden')"
                class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
        </div>
        <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Partner</label>
                <input type="text" name="name" required placeholder="Contoh: Google"
                    class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Logo <span class="text-slate-400 font-normal">(opsional)</span>
                </label>
                <input type="file" name="logo" accept="image/*"
                    class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="document.getElementById('modal-create').classList.add('hidden')"
                    class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ====================== MODAL EDIT ====================== --}}
<div id="modal-edit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-slate-800">Edit Partner</h2>
            <button onclick="document.getElementById('modal-edit').classList.add('hidden')"
                class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
        </div>
        <form id="form-edit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Partner</label>
                <input type="text" id="edit-name" name="name" required
                    class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Logo <span class="text-slate-400 font-normal">(opsional, kosongkan jika tidak ingin mengubah)</span>
                </label>
                <input type="file" name="logo" accept="image/*"
                    class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="document.getElementById('modal-edit').classList.add('hidden')"
                    class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-semibold hover:bg-slate-200 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name) {
    document.getElementById('edit-name').value = name;
    document.getElementById('form-edit').action = '/admin/partners/' + id;
    document.getElementById('modal-edit').classList.remove('hidden');
}

@if($errors->any() && old('_method') === null)
    document.getElementById('modal-create').classList.remove('hidden');
@endif
</script>

@endsection