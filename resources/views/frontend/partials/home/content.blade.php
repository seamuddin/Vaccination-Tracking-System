
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 fade-in">
                    <h1 class="display-4 fw-bold mb-4">Protecting Communities Through Vaccination</h1>
                    <p class="lead mb-4">Find vaccination centers near you and keep track of your immunization schedule with our modern healthcare platform.</p>
                    <div class="search-box">
                        <form class="d-flex gap-2">
                            <input type="text" class="form-control form-control-lg" placeholder="Enter your location">
                            <button class="btn btn-primary btn-lg">Search</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('assets/img/vaccine.png') }}" alt="Vaccination illustration" class="img-fluid rounded-3 floating">
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Access Services -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card h-100 fade-in">
                        <div class="card-body text-center p-5">
                            <div class="service-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h5 class="card-title h4 mb-3">Find Centers</h5>
                            <p class="card-text text-muted mb-4">Locate nearby vaccination facilities with real-time availability and instant booking.</p>
                            <a href="#" class="btn btn-outline-primary">Search Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card h-100 fade-in" style="animation-delay: 0.2s;">
                        <div class="card-body text-center p-5">
                            <div class="service-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h5 class="card-title h4 mb-3">Track Vaccinations</h5>
                            <p class="card-text text-muted mb-4">Monitor your vaccination schedule and get timely reminders for upcoming doses.</p>
                            <a href="#" class="btn btn-outline-primary">Track Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card h-100 fade-in" style="animation-delay: 0.4s;">
                        <div class="card-body text-center p-5">
                            <div class="service-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h5 class="card-title h4 mb-3">Statistics</h5>
                            <p class="card-text text-muted mb-4">View real-time vaccination data and public health statistics in your area.</p>
                            <a href="#" class="btn btn-outline-primary">View Stats</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section py-5">
        <div class="container">
            <h2 class="section-title">Impact Statistics</h2>
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="stats-card floating">
                        <i class="fas fa-syringe fa-2x mb-3" style="color: var(--primary-color)"></i>
                        <h3 class="display-4 fw-bold text-gradient">1M+</h3>
                        <p class="text-muted">Vaccinations Given</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card floating" style="animation-delay: 0.2s;">
                        <i class="fas fa-hospital-alt fa-2x mb-3" style="color: var(--primary-color)"></i>
                        <h3 class="display-4 fw-bold text-gradient">500+</h3>
                        <p class="text-muted">Active Centers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card floating" style="animation-delay: 0.4s;">
                        <i class="fas fa-check-circle fa-2x mb-3" style="color: var(--primary-color)"></i>
                        <h3 class="display-4 fw-bold text-gradient">95%</h3>
                        <p class="text-muted">Success Rate</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card floating" style="animation-delay: 0.6s;">
                        <i class="fas fa-headset fa-2x mb-3" style="color: var(--primary-color)"></i>
                        <h3 class="display-4 fw-bold text-gradient">24/7</h3>
                        <p class="text-muted">Support Available</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vaccination Schedule -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Vaccination Timeline</h2>
            <div class="schedule-timeline">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="timeline-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                        <i class="fas fa-baby"></i>
                                    </div>
                                    <h5 class="card-title h4 mb-0 ms-3">Birth to 15 Months</h5>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-4 d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Hepatitis B (HepB)</h6>
                                            <small class="text-muted">Birth, 1-2 months, 6 months</small>
                                        </div>
                                    </li>
                                    <li class="mb-4 d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Rotavirus (RV)</h6>
                                            <small class="text-muted">2 months, 4 months</small>
                                        </div>
                                    </li>
                                    <li class="mb-4 d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">DTaP</h6>
                                            <small class="text-muted">2 months, 4 months, 6 months</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="timeline-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <h5 class="card-title h4 mb-0 ms-3">4-6 Years</h5>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-4 d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">DTaP Booster</h6>
                                            <small class="text-muted">4-6 years</small>
                                        </div>
                                    </li>
                                    <li class="mb-4 d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">IPV (Polio)</h6>
                                            <small class="text-muted">4-6 years</small>
                                        </div>
                                    </li>
                                    <li class="mb-4 d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <div>
                                            <h6 class="mb-1">MMR</h6>
                                            <small class="text-muted">4-6 years</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Contacts -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Emergency Support</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="emergency-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title h4 mb-1">24/7 Helpline</h5>
                                    <p class="card-text text-muted mb-0">For immediate medical assistance</p>
                                </div>
                            </div>
                            <h3 class="text-primary mb-0">1-800-VACCINE</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="emergency-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title h4 mb-1">Support Email</h5>
                                    <p class="card-text text-muted mb-0">For non-emergency inquiries</p>
                                </div>
                            </div>
                            <h3 class="text-primary mb-0">support@vaxportal.com</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>