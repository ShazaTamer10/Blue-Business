@extends('frontend.layouts.layout')

@section('content')
<div class="container section-padding">
    <h2>Course Contents</h2>
    <div class="row">
        @forelse($contents as $content)
        <div class="col-md-4 mb-4">
            <div class="content-box">
                <h5>{{ $content->title }}</h5>
                @if ($content->type === 'video')
                    <video width="100%" controls>
                        <source src="{{ asset($content->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($content->type === 'pdf')
                    <a href="{{ asset($content->file_path) }}" target="_blank" class="btn btn-primary">
                        View PDF
                    </a>
                @endif
            </div>
        </div>
        @empty
        <p>No course content available.</p>
        @endforelse
    </div>

    {{-- Pagination links --}}
    <div class="pagination justify-content-center">
        {{ $contents->links() }}
    </div>
</div>
@endsection
