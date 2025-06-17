@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Top Up Saldo</h1>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('topup.process') }}">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Top Up</label>
            <input type="number" name="amount" id="amount" class="form-control" min="1000" placeholder="Masukkan nominal" required>
        </div>
        <button type="submit" class="btn btn-primary">Top Up</button>
    </form>
</div>
@endsection
