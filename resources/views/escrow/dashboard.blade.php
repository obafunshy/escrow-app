@extends('layouts.app')

@section('content')
    <h1>Escrow Dashboard</h1>

    @foreach($escrowAgreements as $escrowAgreement)
        <div>
            <p>User ID: {{ $escrowAgreement->user_id }}</p>
            <p>Amount: {{ $escrowAgreement->amount }}</p>
            <p>Status: {{ $escrowAgreement->status }}</p>
            <!-- Add more details as needed -->
        </div>
    @endforeach
@endsection
