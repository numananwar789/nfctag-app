@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h2>Scan Code to complete registration</h2>
            </div>

            {{-- manual login --}}
            <a href="{{ $url }}"> Manual Register </a>
            <div class="card-body text-center">
                {!! QrCode::size(300)->generate($url) !!}
            </div>
        </div>
    </div>
@endsection
