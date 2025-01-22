<!-- Event Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Event list Start -->
            <div class="col-lg-12">
                <div class="row g-5">
                    <!-- Loop through the events -->
                    @foreach($events as $event)
                        <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                <div class="blog-img position-relative overflow-hidden" style="height: 500px;">
                                    <img class="img-fluid h-100 w-100" src="{{ asset($event->image ?? 'frontend/img/cat-3.jpg') }}" alt="">
                                    <a class="position-absolute top-0 end-0 bg-primary text-white rounded me-3 mt-3 py-2 px-4" href="">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
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

                <!-- Pagination -->
                <div class="col-12 text-center mt-5">
                    <!-- This will render the pagination links -->
                    {{ $events->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            <!-- Event list End -->
        </div>
    </div>
</div>
<!-- Event End -->
