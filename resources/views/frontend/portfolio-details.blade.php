@extends('frontend.layouts.layout')

@section('content')

<header class="site-header parallax-bg">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-sm-8">
                <h2 class="title">Portfolio Details</h2>
            </div>
            <div class="col-sm-4">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Portfolio</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Portfolio-Area-Start -->
<section class="portfolio-details section-padding" id="portfolio-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="head-title">{{$portfolio->title}}</h2>
                <figure class="image-block">
<div class="image-container" style="text-align: center;">
    <img src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}"
         style="width: 100%; max-width: 800px; height: auto; border-radius: 8px;">
</div>

<div class="portfolio-gallery">
<br>
    <div class="row">
        @foreach($portfolio->images as $image)
            <div class="col-md-4 mb-3">
                <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid rounded" alt="">
            </div>
        @endforeach
    </div>
</div>

 <div class="description" style="word-wrap: break-word; white-space: normal; text-align: center;">
                    {!!$portfolio->description!!}

                </div>

                </figure>
                <div class="portflio-info">
                    <div class="single-info">
                        <h4 class="title">Client</h4>
                        <p>{{$portfolio->client}}</p>
                    </div>

                    <div class="single-info">
                        <h4 class="title">Website</h4>
                        <p>{{$portfolio->website}}</p>
                    </div>
                    {{-- <div class="single-info">
                        <h4 class="title">Our Role</h4>
                        <p>Online Camopaigns & Web Development</p>
                    </div> --}}
                </div>
               
            </div>
        </div>
    </div>
</section>
<!-- Portfolio-Area-End -->


@endsection
