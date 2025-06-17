@php
    use App\Models\Book;
    $books = Book::latest()->take(5)->get();
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <div class="alert alert-success">
        You're logged in as <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->role }})
    </div>

    <p>Balance: Rp{{ number_format(Auth::user()->balance) }}</p>

    <h3 class="mt-4">Recent Books</h3>
    <ul>
        @foreach (\App\Models\Book::latest()->take(5)->get() as $book)
            <li>{{ $book->title }} by {{ $book->author }}</li>
        @endforeach
    </ul>
</div>
@endsection

