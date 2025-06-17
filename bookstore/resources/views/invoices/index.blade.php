@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Invoices</h1>

    @if ($invoices->isEmpty())
        <p>You have no invoices.</p>
    @else
        <ul class="list-group">
            @foreach ($invoices as $invoice)
                <li class="list-group-item">
                    <a href="{{ route('invoices.show', $invoice->id) }}">
                        Invoice #{{ $invoice->id }} - Rp{{ number_format($invoice->total_price) }} - {{ $invoice->created_at->format('d M Y H:i') }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
