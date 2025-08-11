@extends('frontend.layouts.app')

@section('content')
<!-- Course Application Form -->
<section class="contact-section pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Apply for <span>{{ $course->title }}</span></h2>
            <p>Fill in the form below to apply for this course. We will contact you shortly.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('course.submitApplication', $course->id) }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Your Phone Number" required>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <textarea name="message" rows="5" class="form-control" placeholder="Your Message"></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-lg-12 col-md-12 text-center">
                            <button type="submit" class="default-btn">
                                Submit Application
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
