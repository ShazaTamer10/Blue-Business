
<nav class="navbar navbar-expand-lg main_menu" id="main_menu_area">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="{{asset('frontend/assets/images/logo.png')}}" alt="Blue Business">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/portfolio">Portfolio </a>
                    {{-- <ul class="sub_menu">
                        <li><a href="portfolio.html">Portfolio Grid</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#skills-page">Services</a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="/courses">Courses</a>
                    {{-- <ul class="sub_menu">
                        <li><a href="course.html">Course Grid</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#contact-page">Contact</a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="{{route('blog')}}">Blogs</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
