@extends('layouts.app')
@section('title', 'Laravel - NFC Access Logs')
@section('content')
    <div class="container">
        <h1>NFC Access Logs</h1>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>UID</th>
                    <th>Counter</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->uid }}</td>
                        <td>{{ $log->counter }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ $log->status ? 'Success' : 'Failed' }}</td>
                        <td>{{ $log->created_at->format('d M, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No NFC access logs data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Container -->
        <div class="pagination-container d-flex justify-content-between align-items-center">
            <!-- Pagination Info -->
            <div class="pagination-info">
                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries
            </div>

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
                <ul class="pagination mb-0">
                    <li class="page-item">
                        <a class="page-link" href="{{ $logs->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $logs->lastPage(); $i++)
                        <li class="page-item {{ $i == $logs->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $logs->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" href="{{ $logs->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
