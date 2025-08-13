@extends('frontend.layouts.layout')

@section('content')
<!-- Header-Area-Start -->
@include('frontend.sections.hero')
<!-- Header-Area-End -->

<!-- About-Area-Start -->
@include('frontend.sections.about')
<!-- About-Area-End -->

<!-- Portfolio-Area-Start -->
@include('frontend.sections.portofolio')
<!-- Portfolio-Area-End -->

<!-- Service-Area-Start -->
{{-- @include('frontend.sections.service') --}}
<!-- Service-Area-End -->

<!-- Experience-Area-Start -->
{{-- @include('frontend.sections.experience') --}}
<!-- Experience-Area-End -->

<!-- Testimonial-Area-Start -->
<br>
<br>
<br>
<br>
{{-- @include('frontend.sections.testimonial')
<!-- Testimonial-Area-End --> --}}

<!-- Blog-Area-Start -->
@include('frontend.sections.blog')
<!-- Blog-Area-End -->

<!-- Blog-Area-Start -->
@include('frontend.sections.course')
<!-- Blog-Area-End -->

<!-- Blog-Area-Start -->
@include('frontend.sections.team', ['teamMembers' => $teamMembers])
<!-- Blog-Area-End -->

<!-- Contact-Area-Start -->
{{-- @include('frontend.sections.contact') --}}
<!-- Contact-Area-End -->
<br>
<br>
@endsection


