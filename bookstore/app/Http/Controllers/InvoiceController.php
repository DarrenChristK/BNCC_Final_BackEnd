<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('user_id', Auth::id())->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->user_id !== Auth::id()) {
            abort(403);
        }

        $invoice->load('items.book');
        return view('invoices.show', compact('invoice'));
    }
}

