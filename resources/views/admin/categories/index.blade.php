@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Kategori</h1>
            <p class="text-slate-500">Kelola kategori event (contoh: Seminar, Konser, Workshop).</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-sm">
            + Tambah Kategori
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="p-4 font-semibold text-slate-600 w-16">No</th>
                    <th class="p-4 font-semibold text-slate-600">Nama Kategori</th>
                    <th class="p-4 font-semibold text-slate-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                    <td class="p-4 text-slate-500">1</td>
                    <td class="p-4 font-medium text-slate-800">Seminar</td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 font-medium mr-4">Edit</button>
                        <button class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                    </td>
                </tr>
                <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                    <td class="p-4 text-slate-500">2</td>
                    <td class="p-4 font-medium text-slate-800">Konser</td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 font-medium mr-4">Edit</button>
                        <button class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 text-slate-500">3</td>
                    <td class="p-4 font-medium text-slate-800">Workshop</td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 font-medium mr-4">Edit</button>
                        <button class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection