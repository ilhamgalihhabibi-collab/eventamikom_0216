<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengarah ke halaman view index transaksi admin
        return view('admin.transactions.index');
    }
}