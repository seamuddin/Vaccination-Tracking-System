<!-- Event Start -->
<div class="container-fluid event my-5 py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Events</div>
            <h1 class="display-6 mb-5">All Latest Events</h1>
        </div>

        <!-- Display Error if Available -->
        @if(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        <!-- Display Events -->
        @if($events->isNotEmpty())
            <div class="row g-5">
                @foreach($events as $event)
                    <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                        <div class="blog-item bg-light rounded overflow-hidden">
                            <div class="blog-img position-relative overflow-hidden" style="height: 300px;">
                                <img class="img-fluid h-100 w-100" src="{{ asset($event->image ?? 'frontend/img/cat-3.jpg') }}" alt="">
                                <a class="position-absolute top-0 end-0 bg-primary text-white rounded me-3 mt-3 py-2 px-4" href="">
                                    <!-- Check if event date is valid and format it -->
                                    @if($event->event_date)
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                    @else
                                        <!-- If the date is null, do not display anything -->
                                        Not Found
                                    @endif
                                </a>

                            </div>
                            <div class="p-4">
                                <h4 class="mb-3">{{ $event->title }}</h4>
                                <p>{{ Str::limit($event->description, 100) }}</p>
                                <a class="text-uppercase" href="{{ route('event_details', $event->id) }}">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <p>No events found.</p>
            </div>
        @endif

        <!-- Load More Button -->
        <div class="text-center my-5">
            <a class="btn btn-primary py-2 px-3 animated slideInDown" href="{{ route('event_page') }}">
                More
                <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                    <i class="fa fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Event End -->
