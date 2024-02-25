<section class="slider">
    <div class="banner">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-inner">
                @foreach($slides as $key => $slide)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="10000">
                        <img src="{{ generateThumbnail('storage/'.$slide->image,1920,545,true) }}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $slide->title }}</h5>
                            <p>{{ $slide->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
