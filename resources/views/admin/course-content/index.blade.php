@extends('admin.layouts.layout')

@section('content')
<h1>Contents of: {{ $course->title }}</h1>

<a href="{{ route('admin.course.contents.create', $course->id) }}" class="btn btn-primary mb-3">Add New Content</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Order</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contents as $content)
        <tr>
            <td>{{ $content->title }}</td>
            <td>{{ $content->order }}</td>
            <td>
                <a href="{{ route('admin.course.contents.edit', [$course->id, $content->id]) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('admin.course.contents.destroy', [$course->id, $content->id]) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $contents->links() }}

<a href="{{ route('admin.course.index') }}" class="btn btn-secondary mt-3">Back to Courses</a>
@endsection
