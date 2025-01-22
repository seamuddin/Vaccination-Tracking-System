<!-- Committee Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Committee list Start -->
            <div class="col-lg-12">
                <div class="row g-5">
                    <!-- Loop through the committees -->
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="col-12 text-center mt-5">
                    <!-- This will render the pagination links -->
                    {{ $committees->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            <!-- Committee list End -->
        </div>
    </div>
</div>
<!-- Committee End -->
