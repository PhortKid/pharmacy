@extends('dash_layout.app')

@section('content')
<div class="container">
    <h2>Audit Logs</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Table</th>
                <th>Old Data</th>
                <th>New Data</th>
                <th>IP Address</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->user->name ?? 'System' }}</td>
                    <td>{{ ucfirst($log->event) }}</td>
                    <td>{{ $log->table_name }}</td>
                    <td><pre>{{ json_encode($log->old_data, JSON_PRETTY_PRINT) }}</pre></td>
                    <td><pre>{{ json_encode($log->new_data, JSON_PRETTY_PRINT) }}</pre></td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ $log->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</div>
@endsection
