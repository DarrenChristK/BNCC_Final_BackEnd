@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $book->title }}">
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ $book->author }}">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $book->price }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $book->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
