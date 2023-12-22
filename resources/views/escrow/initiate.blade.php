@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Initiate Escrow Agreement</h1>

        <form method="post" action="{{ route('escrow.initiate') }}">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID:</label>
                <input type="text" name="user_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Amount:</label>
                <input type="number" name="amount" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="escrow_agreement_id" class="form-label">Escrow Agreement ID:</label>
                <input type="text" name="escrow_agreement_id" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Initiate Escrow</button>
        </form>
    </div>

@endsection
