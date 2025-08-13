@extends('frontend.layouts.layout')
@section('content')

<!-- Header -->
<header class="site-header parallax-bg">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-sm-8">
                <h2 class="title">{{ $course->title }}</h2>
            </div>
            {{-- Optional breadcrumbs --}}
            {{-- 
            <div class="col-sm-4">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                        <li>{{ $course->title }}</li>
                    </ul>
                </div>
            </div>
            --}}
        </div>
    </div>
</header>

<!-- Course Details Section -->
<section class="blog-details section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

               

                <!-- Course Video -->
                @if($course->video_path)
                    <figure class="image-block">
                        <video width="100%" height="400" controls>
                            <source src="{{ asset('storage/' . $course->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </figure>
                @elseif($course->video_url)
                    <!-- fallback to video_url if exists -->
                    <figure class="image-block">
                        <iframe width="100%" height="400"
                            src="{{ $course->video_url }}"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    </figure>
                @endif

                <!-- Course Description -->
                <div class="description" style="word-wrap: break-word; white-space: normal; text-align: center;">
                    {!! $course->description !!}
                </div>

                <br>
                
<div>
                   @if ($course->pdf_path)
    <a href="{{ asset('storage/' . $course->pdf_path) }}" 
      class="button-orange mouse-dir"
       download>
Download PDF    </a>
@endif
</div>

<br>

 <!-- Course Meta -->
                <div class="blog-meta">
                    <div class="single-meta">
                        <div class="meta-title">Published</div>
                        <h4 class="meta-value"><a href="javascript:void(0)">{{ date('D, M Y', strtotime($course->created_at)) }}</a></h4>
                    </div>
                    {{-- 
                    <div class="single-meta">
                        <div class="meta-title">Category</div>
                        <h4 class="meta-value"><a href="javascript:void(0)">{{ $course->category->name ?? 'Uncategorized' }}</a></h4>
                    </div>
                    --}}
                </div>



                <!-- Apply Button -->
                <div class="mt-4">
                    <a href="{{ route('course.apply', $course->id) }}" class="button-orange mouse-dir">
                        Apply Now <span class="dir-part"></span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
