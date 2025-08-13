<section class="blog-area section-padding-top" id="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title">Our  Team</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="blog-slider" id="team">
                    @foreach($teamMembers as $member)
                        <div class="single-blog">
                            <figure class="blog-image">
                                @if($member->image && file_exists(public_path('storage/' . $member->image)))
                                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}">
                                @else
                                    <img src="{{ asset('frontend/assets/images/default-team.png') }}" alt="{{ $member->name }}">
                                @endif
                            </figure>
                            <div class="blog-content">
                                <h3 class="title" >
                                    <a href="#" >{{ $member->name }}</a>
                                </h3>
                                <div class="desc">
                                    <p>{{ $member->position }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
