
@extends('admin.layouts.layout')

@section('content')
<br>
<div class="container mt-4">

{{-- <h2 class="fw-bold display-5">Application Details</h2> --}}

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Course:</strong> {{ $application->course->title }}</p>
            <p><strong>Name:</strong> {{ $application->name }}</p>
            <p><strong>Email:</strong> {{ $application->email }}</p>
            <p><strong>Phone:</strong> {{ $application->phone ?? '-' }}</p>
            <p><strong>Message:</strong> {{ $application->message ?? '-' }}</p>
            <p><strong>Applied At:</strong> {{ $application->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.course-applications.index') }}" class="btn btn-secondary mt-3">Back to list</a>
</div>
@endsection
