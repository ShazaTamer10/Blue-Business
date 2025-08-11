@extends('admin.layouts.layout')

@section('content')
<h1>Add Content to: {{ $course->title }}</h1>

<form action="{{ route('admin.course.contents.store', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Video URL</label>
        <input type="url" name="video_url" class="form-control">
    </div>

    <div class="mb-3">
        <label>PDF File</label>
        <input type="file" name="pdf_path" accept="application/pdf" class="form-control">
    </div>

    <div class="mb-3">
        <label>Order</label>
        <input type="number" name="order" class="form-control" value="0">
    </div>

    <button type="submit" class="btn btn-success">Add Content</button>
</form>

<a href="{{ route('admin.courses.contents.index', $course->id) }}" class="btn btn-secondary mt-3">Back to Contents</a>
@endsection
