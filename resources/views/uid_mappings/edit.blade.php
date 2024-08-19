@extends('layouts.app')
@section('title', 'Laravel - Edit UID Mapping')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Edit UID Mapping</h1>
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

        <form action="{{ route('uid-mappings.update', $uidMapping->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="old_uid">Old UID</label>
                <input type="text" name="old_uid" class="form-control" value="{{ old('old_uid', $uidMapping->old_uid) }}">
            </div>
            <div class="form-group">
                <label for="new_uid">New UID</label>
                <input type="text" name="new_uid" class="form-control"
                    value="{{ old('new_uid', $uidMapping->new_uid) }}">
            </div>
            <div class="form-group">
                <label for="counter">Counter</label>
                <input type="number" name="counter" class="form-control"
                    value="{{ old('counter', $uidMapping->counter) }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
        </form>
    </div>
@endsection
