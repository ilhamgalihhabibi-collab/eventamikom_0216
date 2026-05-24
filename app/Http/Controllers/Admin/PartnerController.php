<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $partners = Partner::when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.partners.index', compact('partners', 'search'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name'  => 'required|string|max:255|unique:partners,name',
        'logo'  => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
    ]);

    $logoPath = null;
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('partners', 'public');
    }

    Partner::create([
        'name'     => $request->name,
        'logo_url' => $logoPath ? asset('storage/' . $logoPath) : null,
    ]);

    return redirect()->route('admin.partners.index')
        ->with('success', 'Partner berhasil ditambahkan.');
}

public function update(Request $request, Partner $partner)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:partners,name,' . $partner->id,
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
    ]);

    $logoPath = $partner->logo_url; // tetap pakai yang lama jika tidak upload baru
    if ($request->hasFile('logo')) {
        $newPath = $request->file('logo')->store('partners', 'public');
        $logoPath = asset('storage/' . $newPath);
    }

    $partner->update([
        'name'     => $request->name,
        'logo_url' => $logoPath,
    ]);

    return redirect()->route('admin.partners.index')
        ->with('success', 'Partner berhasil diperbarui.');
}

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}