@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">List of Books</h1>


    @auth
        @if (Auth::user()->isAdmin())
            <a href="{{ route('books.create') }}" class="btn btn-success">Add New Book</a>
        @endif
    @endauth

    @auth
    <p>You are logged in as: {{ Auth::user()->role }}</p>
    @endauth


    <form method="GET" action="{{ route('books.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search books..." value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price (Rp)</th>
                <th>Actions</th>
                <th>Cover</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ number_format($book->price) }}</td>
                    <td>

                        @auth
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        @endauth


                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>


                        @auth
                            @if (!Auth::user()->isAdmin())
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Add to Cart</button>
                                </form>
                            @endif
                        @endauth
                    </td>

                    <td>
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" width="60" />
                        @else
                            No image
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
