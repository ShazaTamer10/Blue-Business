@extends('frontend.layouts.layout')

@section('content')
<div class="container section-padding">
    <div class="text-center mb-5">
        <h2 class="section-title">Course Contents</h2>
        <p class="section-subtitle">Explore the resources included in this course</p>
    </div>

    <div class="row">
        @forelse($contents as $content)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $content->title }}</h5>

                        @if ($content->type === 'video')
                            <div class="mb-3 mt-2" style="position: relative; padding-top: 56.25%;">
                                <video style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" controls>
                                    <source src="{{ asset('storage/' . $content->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @elseif ($content->type === 'pdf')
                            <div class="mt-auto pt-3">
                                <a href="{{ asset('storage/' . $content->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-file-pdf"></i> View PDF
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No course content available.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $contents->links() }}
    </div>
</div>
@endsection
