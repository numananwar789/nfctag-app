{{-- resources/views/nfc_tags/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Laravel - Create NFC Tag')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Create New QR</h1>
            <a href="/admin/nfc-tags" class="btn btn-secondary btn-sm">Go back</a>
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

        <form action="{{ route('qr-register.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="uid">URL</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
            </div>
            <div class="form-group">
                <label for="uid">UID</label>
                <select name="uid" class="form-control">
                    <option value="default" disabled selected>Select UID</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->uid }}">{{ $tag->uid }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
@endsection
