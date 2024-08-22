@extends('layouts.app')
@section('title', 'Laravel - Edit NFC Tag')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Edit NFC Tag</h1>
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

        <form action="{{ route('nfc-tags.update', $nfcTag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="uid">UID</label>
                <input type="text" name="uid" class="form-control" value="{{ old('uid', $nfcTag->uid) }}">
            </div>
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $nfcTag->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
        </form>
    </div>
@endsection
