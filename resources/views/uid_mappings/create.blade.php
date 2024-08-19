@extends('layouts.app')
@section('title', 'Laravel - Create UID Mapping')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Create New UID Mapping</h1>
            <a href="{{ route('uid-mappings.index') }}" class="btn btn-secondary btn-sm">Go back</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('uid-mappings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="old_uid">Old UID</label>
                <input type="text" name="old_uid" class="form-control" value="{{ old('old_uid') }}">
            </div>
            <div class="form-group">
                <label for="new_uid">New UID</label>
                <input type="text" name="new_uid" class="form-control" value="{{ old('new_uid') }}">
            </div>
            <div class="form-group">
                <label for="counter">Counter</label>
                <input type="number" name="counter" class="form-control" value="{{ old('counter') }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Create</button>
        </form>
    </div>
@endsection
