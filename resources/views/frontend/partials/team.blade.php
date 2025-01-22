<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Team Members</div>
            <h1 class="display-6 mb-5">Let's Meet With Our Ordinary Soldiers</h1>
        </div>

        <!-- Display Error if Available -->
        @if(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        @if($committees->isNotEmpty())
        <div class="row g-4">
            @foreach($committees as $committee)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden" style="height: 250px;">
                        <img class="img-fluid h-100 w-100" src="{{ asset($committee->image ?? 'frontend/img/cat-3.jpg') }}" alt="">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>{{ $committee->name }}</h5>
                        <p class="text-primary">{{ $committee->designation }}</p>
                        <div class="team-social text-center">
                            <a class="btn btn-square" href="{{ $committee->facebook }}"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square" href="{{ $committee->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
{{--                            <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>--}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <div class="text-center">
                <p>No committees found.</p>
            </div>
        @endif

        <!-- Load More Button -->
        <div class="text-center my-5">
            <a class="btn btn-primary py-2 px-3 animated slideInDown" href="{{ route('committee_page') }}">
                More
                <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                    <i class="fa fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Team End -->
