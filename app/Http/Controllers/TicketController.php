<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Method untuk halaman my-ticket
    public function index()
    {
        return view('ticket');
    }
}