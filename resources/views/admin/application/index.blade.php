@extends('admin.layouts.layout')

@section('content')
<br>
<div class="container mt-4">
    <h2>  </h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Name</th>
                <th>Email</th>
                <th>Applied At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
            <tr>
                <td>{{ $application->id }}</td>
                <td>{{ $application->course->title }}</td>
                <td>{{ $application->name }}</td>
                <td>{{ $application->email }}</td>
                <td>{{ $application->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.course-applications.show', $application->id) }}" class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No applications found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $applications->links() }}
</div>
@endsection
