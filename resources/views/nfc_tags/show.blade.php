@extends('layouts.app')
@section('title', 'Laravel - Edit NFC Tag')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h2>Scan QrCode to get registered</h2>
            </div>
            
            <div class="card-body text-center">
                {!! QrCode::size(300)->generate($url) !!}
            </div>
        </div>
    </div>
@endsection
