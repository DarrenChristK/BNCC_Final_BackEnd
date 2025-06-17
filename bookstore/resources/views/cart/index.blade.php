@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    <p><strong>Balance:</strong> Rp{{ number_format(Auth::user()->balance) }}</p>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->book->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->book->price * $item->quantity) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end mt-3">
            <h5>Total: <strong>Rp{{ number_format($total) }}</strong></h5>
        </div>

        <form action="{{ route('cart.checkout') }}" method="POST" class="mt-3">
            @csrf
            <button class="btn btn-primary">Checkout</button>
        </form>
    @endif
</div>
@endsection
