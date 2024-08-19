{{-- resources/views/uid_mappings/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Laravel - UID Mappings')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>UID Mappings</h1>
            <a href="{{ route('uid-mappings.create') }}" class="btn btn-primary btn-sm">Create New UID Mapping</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Old UID</th>
                    <th>New UID</th>
                    <th>Counter</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mappings as $mapping)
                    <tr>
                        <td>{{ $mapping->id }}</td>
                        <td>{{ $mapping->old_uid }}</td>
                        <td>{{ $mapping->new_uid }}</td>
                        <td>{{ $mapping->counter }}</td>
                        <td>
                            <a href="{{ route('uid-mappings.edit', $mapping->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('uid-mappings.destroy', $mapping->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No UID Mappings data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
