{{-- resources/views/nfc_tags/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Laravel - NFC Tags')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>NFC Tags</h1>
            <a href="{{ route('nfc-tags.create') }}" class="btn btn-primary btn-sm">Create New NFC Tag</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>UID</th>
                    <th>User</th>
                    <th>Counter</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->uid }}</td>
                        <td>{{ $tag->user->name }}</td>
                        <td>{{ $tag->counter }}</td>
                        <td>
                            <a href="{{ route('nfc-tags.show', $tag->id) }}" class="btn btn-info btn-sm">View QR Code</a>
                            <a href="{{ route('nfc-tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('nfc-tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No NFC tags data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
