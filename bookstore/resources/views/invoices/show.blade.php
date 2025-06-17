@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoice #{{ $invoice->id }}</h1>
    <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y H:i') }}</p>
    <p><strong>Total:</strong> Rp{{ number_format($invoice->total_price) }}</p>

    <h4 class="mt-4">Items:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Book</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
