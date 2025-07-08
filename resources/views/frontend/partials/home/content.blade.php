 <!-- Hero Section -->
 <section class="hero" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1>Track Your Child's Vaccinations Easily and Stay Informed</h1>
                <p class="lead">Keep your family protected with our comprehensive vaccine tracking system. Never miss an important vaccination again with personalized reminders and easy scheduling.</p>
                <div class="cta-buttons">
                    <a href="#schedule" class="btn-cta btn-secondary-cta" aria-label="Explore vaccine schedules">
                        <i class="fas fa-calendar-alt me-2"></i>Explore Schedule
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image mt-4 mt-lg-0">
                    <img class="img-fluid p-5" src="{{ asset('assets/img/vaccine.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="search-section" id="centers">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="search-card">
                    <div class="search-header">
                        <h2>Find Vaccination Centers Near You</h2>
                        <p>Discover nearby healthcare providers offering vaccination services for your family</p>
                    </div>
                    
                    <div class="search-container">
                        <form onsubmit="searchCenters(event)">
                            <div class="search-input-group">
                                <i class="fas fa-map-marker-alt search-icon"></i>
                                <input type="text" class="search-input" id="locationSearch" 
                                       placeholder="Enter your zip code, city, or address..." 
                                       aria-label="Enter your location to search for vaccination centers" required>
                                <button type="submit" class="btn-search" aria-label="Search for vaccination centers">
                                    <i class="fas fa-search me-2"></i>Search Centers
                                </button>
                            </div>
                        </form>
                        
                        <div class="search-suggestions">
                            <p class="text-muted mb-2">Popular searches:</p>
                            <div class="suggestion-chips">
                                @foreach($popularCenters as $center)
                                    <span class="suggestion-chip" onclick="quickSearch('{{ $center }}')">{{ $center }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div id="searchResults" class="search-results" role="region" aria-live="polite"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Milestones Section -->
<section class="milestones" id="schedule">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold">Vaccination Milestones</h2>
                <p class="lead">Keep track of your child's vaccination schedule with these important milestones</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="milestone-card">
                    <div class="milestone-icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h4>Birth - 2 Months</h4>
                    <p>Hepatitis B, DTaP, Hib, PCV13, IPV, Rotavirus</p>
                    <small class="text-muted">Critical early protection</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="milestone-card">
                    <div class="milestone-icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <h4>4 - 6 Months</h4>
                    <p>DTaP, Hib, PCV13, IPV, Rotavirus boosters</p>
                    <small class="text-muted">Building immunity</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="milestone-card">
                    <div class="milestone-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h4>12 - 15 Months</h4>
                    <p>MMR, PCV13, Hib, Varicella, Hepatitis A</p>
                    <small class="text-muted">Toddler protection</small>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="milestone-card">
                    <div class="milestone-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>4 - 6 Years</h4>
                    <p>DTaP, IPV, MMR, Varicella boosters</p>
                    <small class="text-muted">School readiness</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="about">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold">Why Choose VaxTracker?</h2>
                <p class="lead">Comprehensive vaccination management made simple</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Smart Reminders</h4>
                    <p>Never miss a vaccination with personalized alerts and notifications sent directly to your phone or email.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Find Centers</h4>
                    <p>Locate nearby vaccination centers with real-time availability and appointment scheduling capabilities.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Secure Records</h4>
                    <p>Keep all vaccination records safe and accessible with our HIPAA-compliant digital storage system.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Family Management</h4>
                    <p>Track vaccinations for multiple children and family members from a single, easy-to-use dashboard.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Mobile Access</h4>
                    <p>Access your vaccination records anywhere, anytime with our responsive mobile-friendly platform.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Health Insights</h4>
                    <p>Receive educational content about vaccines and personalized health recommendations for your family.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold">What Parents Are Saying</h2>
                <p class="lead">Trusted by thousands of families nationwide</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <p>VaxTracker has been a lifesaver! I never have to worry about missing my daughter's vaccinations anymore. The reminders are so helpful.</p>
                    <div class="mt-3">
                        <strong>Sarah M.</strong>
                        <div class="text-muted">Mother of 2</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <p>The ability to find vaccination centers nearby is fantastic. I found a clinic just 5 minutes from my home that I didn't even know existed!</p>
                    <div class="mt-3">
                        <strong>Mike R.</strong>
                        <div class="text-muted">Father of 3</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <p>As a working parent, having all my children's vaccination records in one place makes everything so much easier. Highly recommend!</p>
                    <div class="mt-3">
                        <strong>Jennifer L.</strong>
                        <div class="text-muted">Working Mom</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <div class="section-header">
                    <h2 class="display-5 fw-bold">Frequently Asked Questions</h2>
                    <p class="lead">Get answers to common questions about VaxTracker</p>
                    <div class="header-decoration"></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">
                            <div class="faq-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <h5>Is VaxTracker free to use?</h5>
                            <div class="faq-toggle">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div id="faq1" class="faq-answer collapse show">
                            <div class="faq-content">
                                <p>Basic tracking features are completely free for all families. This includes vaccination reminders, record storage, and center locator. Premium features like advanced family management, detailed health insights, and priority support are available with our paid plans starting at $4.99/month.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                            <div class="faq-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h5>How secure is my family's health information?</h5>
                            <div class="faq-toggle">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div id="faq2" class="faq-answer collapse">
                            <div class="faq-content">
                                <p>Your family's privacy and security are our top priorities. We use industry-standard 256-bit SSL encryption and are fully HIPAA-compliant. Your data is stored securely in encrypted databases and never shared with third parties without your explicit permission. All our staff undergo regular security training.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                            <div class="faq-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h5>Can I access my records from my mobile phone?</h5>
                            <div class="faq-toggle">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div id="faq3" class="faq-answer collapse">
                            <div class="faq-content">
                                <p>Absolutely! VaxTracker is fully responsive and works perfectly on all devices including smartphones, tablets, and desktops. We also have dedicated mobile apps for iOS and Android with offline access capabilities, so you can view your vaccination records even without an internet connection.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                            <div class="faq-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <h5>How do vaccination reminders work?</h5>
                            <div class="faq-toggle">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div id="faq4" class="faq-answer collapse">
                            <div class="faq-content">
                                <p>Our smart reminder system sends notifications via email, SMS, or push notifications based on your preferences. Reminders are sent 2 weeks, 1 week, and 1 day before scheduled vaccinations. You can customize reminder timing and frequency in your account settings.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                            <div class="faq-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5>Can I manage multiple children's vaccinations?</h5>
                            <div class="faq-toggle">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div id="faq5" class="faq-answer collapse">
                            <div class="faq-content">
                                <p>Yes! You can manage vaccination records for your entire family from a single account. Add multiple children, set individual reminder preferences, and track different vaccination schedules. Family members can also have their own login access to view their records while you maintain parental oversight.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-footer">
                    <div class="contact-card">
                        <h5>Still have questions?</h5>
                        <p>Our support team is here to help you 24/7</p>
                        <div class="contact-options">
                            <a href="#" class="btn-contact">
                                <i class="fas fa-comments me-2"></i>Live Chat
                            </a>
                            <a href="#" class="btn-contact">
                                <i class="fas fa-envelope me-2"></i>Email Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>