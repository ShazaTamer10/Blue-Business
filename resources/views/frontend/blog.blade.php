@extends('frontend.layouts.layout')

@section('content')
<header class="site-header parallax-bg">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-sm-7">
                <h2 class="title">Blogs</h2>
            </div>
            {{-- <div class="col-sm-5">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
</header>

<!-- Portfolio-Area-Start -->
<section class="blog-area section-padding">
    <div class="container">
        <div class="row">


            @foreach ($blogs as $blog )


            <div class="col-xl-4 col-md-6">
                <div class="single-blog">
                    <figure class="blog-image">
                        <img src="{{asset($blog->image)}}" alt="">
                    </figure>
                    <div class="blog-content">
                        <h3 class="title"><a href="blog-details.html">{{$blog->title}}</a></h3>
                        <div class="desc">
                            <p>{!! Str::limit($blog->description,150,'...') !!}</p>
                        </div>
                        <a href="#" class="button-primary-trans mouse-dir">Read More <span
                                class="dir-part"></span> <i class="fal fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
        <div class="row">
            <div class="col-sm-12 text-center">

                <nav class="navigation pagination">
                    <div class="nav-links d-flex justify-content-center ">
                        {{$blogs->links()}}

                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio-Area-End -->

<!-- Quote-Area-Start -->
<section class="quote-area section-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="quote-box">

                    <div class="row ">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="quote-content">
                                <h3 class="title">Start Journey Today</h3>
                                <div class="desc">
                                    <p>Earum quos animi numquam excepturi eveniet explicabo repellendus rem
                                        esse.
                                        Quae quasi
                                        odio enim.</p>
                                </div>
                                <a href="#" class="button-orange mouse-dir">Get Started <span
                                        class="dir-part"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Quote-Area-End -->
@endsection
