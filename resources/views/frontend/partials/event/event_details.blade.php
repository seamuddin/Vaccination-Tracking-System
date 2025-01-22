<!-- Event Details Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Event Detail Start -->
                <div class="mb-5">
                    <img class="img-fluid h-100 w-100" src="{{ asset($event->image ?? 'frontend/img/cat-3.jpg') }}" alt="">
                    <h1 class="mb-4">{{ $event->title }}</h1>
                    <p>{{ $event->description }}</p>
                </div>
                <!-- Event Detail End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">

                <!-- Recent Post Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Recent Events</h3>
                    </div>
                    @foreach($relatedEvents as $relatedEvent)
                        <div class="d-flex rounded overflow-hidden mb-3">
                            <img class="img-fluid" src="{{ asset($relatedEvent->image ?? 'frontend/img/cat-3.jpg') }}" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                            <!-- Correct the href to point to the related event -->
                            <a href="{{ route('event_details', $relatedEvent->id) }}" class="h5 fw-semi-bold d-flex align-items-center bg-light px-3 mb-0">
                                {{ $relatedEvent->title }}
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Recent Post End -->

            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Event Details End -->
