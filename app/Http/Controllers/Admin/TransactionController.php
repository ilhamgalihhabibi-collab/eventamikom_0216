<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('event')->latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function downloadPDF()
    {
        $transactions = Transaction::with('event')->latest()->get();
        
        $pdf = Pdf::loadView('admin.transactions.report', compact('transactions'));
        
        return $pdf->download('Laporan-Transaksi-' . date('Y-m-d') . '.pdf');
    }
}