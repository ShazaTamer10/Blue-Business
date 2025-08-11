@extends('admin.layouts.layout')

@section('content')
<h1>Edit Content for: {{ $course->title }}</h1>

<form action="{{ route('admin.course.contents.update', [$course->id, $content->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" value="{{ $content->title }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $content->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Video URL</label>
        <input type="url" name="video_url" value="{{ $content->video_url }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>PDF File</label>
        <input type="file" name="pdf_path" accept="application/pdf" class="form-control">
        @if($content->pdf_path)
            <a href="{{ asset('storage/' . $content->pdf_path) }}" target="_blank">Current PDF</a>
        @endif
    </div>

    <div class="mb-3">
        <label>Order</label>
        <input type="number" name="order" value="{{ $content->order }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Content</button>
</form>

<a href="{{ route('admin.course.contents.index', $course->id) }}" class="btn btn-secondary mt-3">Back to Contents</a>
@endsection
