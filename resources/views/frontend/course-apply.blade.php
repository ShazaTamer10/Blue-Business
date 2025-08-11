@extends('frontend.layouts.layout')



@section('content')

<div class="container mt-5 pt-5"> {{-- mt-5 = margin-top, pt-5 = padding-top --}}
    <div class="row">
        <!-- Left Column: Course Info -->
        <div class="col-lg-6">
            <h2>{{ $course->title }}</h2>
            @if($course->video_url)
                <div class="mb-3">
                    <iframe width="100%" height="315" src="{{ $course->video_url }}" frameborder="0" allowfullscreen></iframe>
                </div>
            @endif
            {{-- <p>{{ $course->description }}</p> --}}
        </div>

        <!-- Right Column: Form -->
        <div class="col-lg-6">
            <div class="p-4 bg-white shadow rounded">
                <h3 class="mb-3">Apply Now</h3>
                <form action="{{ route('course.submitApplication', $course->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
