@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>

    @if ($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" width="200">
    @endif

    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Price:</strong> Rp{{ number_format($book->price) }}</p>
    <p><strong>Description:</strong> {{ $book->description }}</p>

    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
@endsection
