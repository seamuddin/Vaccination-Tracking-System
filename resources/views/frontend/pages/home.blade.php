@extends('frontend.index')
@section('title')
    Track Your Child's Vaccinations Easily
@endsection
@section('styles')
@endsection


@section('content')
    @include('frontend.partials.home.content')
@endsection



@section('scripts')
    <!-- Bootstrap JS -->    
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 70; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar background opacity on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNav');
            if (window.scrollY > 100) {
                navbar.style.background = 'linear-gradient(135deg, rgba(79, 70, 229, 0.95), rgba(124, 58, 237, 0.95))';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, var(--primary-color), var(--secondary-color))';
                navbar.style.backdropFilter = 'none';
            }
        });

        // Search functionality
        function searchCenters(event) {
            event.preventDefault();
            const location = document.getElementById('locationSearch').value;
            const resultsDiv = document.getElementById('searchResults');
            
            // Show loading state
            resultsDiv.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Searching for vaccination centers near ${location}...</p>
                </div>
            `;
            
            // Simulate API call with timeout
            setTimeout(() => {
                const mockResults = [
                    {
                        name: "City Health Center",
                        address: "123 Main St, " + location,
                        distance: "0.5 miles",
                        phone: "(555) 123-4567",
                        hours: "Mon-Fri: 8AM-5PM",
                        rating: "4.8",
                        services: "Pediatric & Adult Vaccines"
                    },
                    {
                        name: "Family Medical Clinic",
                        address: "456 Oak Ave, " + location,
                        distance: "1.2 miles",
                        phone: "(555) 987-6543",
                        hours: "Mon-Sat: 9AM-6PM",
                        rating: "4.6",
                        services: "Walk-ins Welcome"
                    },
                    {
                        name: "Pediatric Care Center",
                        address: "789 Pine Rd, " + location,
                        distance: "2.1 miles",
                        phone: "(555) 456-7890",
                        hours: "Mon-Fri: 7AM-7PM",
                        rating: "4.9",
                        services: "Specialized Pediatric Care"
                    }
                ];

                let resultsHTML = `<div class="row"><div class="col-12"><h4 class="mb-3">Found ${mockResults.length} vaccination centers near ${location}</h4></div></div>`;
                
                mockResults.forEach((center, index) => {
                    resultsHTML += `
                        <div class="result-card">
                            <div class="result-header">
                                <div>
                                    <h5 class="result-title">${center.name}</h5>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="text-warning me-2">
                                            ${'★'.repeat(Math.floor(parseFloat(center.rating)))}${'☆'.repeat(5-Math.floor(parseFloat(center.rating)))}
                                        </div>
                                        <span class="text-muted">${center.rating} (Reviews)</span>
                                    </div>
                                </div>
                                <span class="result-distance">${center.distance}</span>
                            </div>
                            
                            <div class="result-details">
                                <div class="result-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    ${center.address}
                                </div>
                                <div class="result-detail">
                                    <i class="fas fa-phone"></i>
                                    ${center.phone}
                                </div>
                                <div class="result-detail">
                                    <i class="fas fa-clock"></i>
                                    ${center.hours}
                                </div>
                                <div class="result-detail">
                                    <i class="fas fa-syringe"></i>
                                    ${center.services}
                                </div>
                            </div>
                            
                            <div class="result-actions">
                                <button class="btn-book" onclick="bookAppointment('${center.name}')">
                                    <i class="fas fa-calendar-plus me-1"></i>Book Appointment
                                </button>
                                <a href="#" class="btn-directions" onclick="getDirections('${center.address}')">
                                    <i class="fas fa-directions me-1"></i>Get Directions
                                </a>
                            </div>
                        </div>
                    `;
                });

                resultsDiv.innerHTML = resultsHTML;
            }, 1500);
        }

        // Quick search functionality
        function quickSearch(location) {
            document.getElementById('locationSearch').value = location;
            searchCenters({preventDefault: () => {}});
        }

        // Get directions function
        function getDirections(address) {
            alert(`Getting directions to ${address}. In a real application, this would open the map application.`);
        }

        // Book appointment function
        function bookAppointment(centerName) {
            alert(`Booking appointment at ${centerName}. In a real application, this would open the booking system.`);
        }

        // Login modal function
        function openLoginModal() {
            alert('Login/Registration system would open here. In a real application, this would show a proper authentication modal or redirect to the login page.');
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);

        // Observe all milestone cards and feature items
        document.addEventListener('DOMContentLoaded', function() {
            const elementsToAnimate = document.querySelectorAll('.milestone-card, .feature-item, .testimonial-card');
            elementsToAnimate.forEach(el => observer.observe(el));
        });

        // Keyboard accessibility improvements
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });

        // FAQ Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const isActive = this.getAttribute('aria-expanded') === 'true';
                    
                    // Close all other FAQ items
                    faqQuestions.forEach(q => {
                        q.setAttribute('aria-expanded', 'false');
                        const icon = q.querySelector('.faq-toggle i');
                        icon.style.transform = 'rotate(0deg)';
                    });
                    
                    // Toggle current item
                    if (!isActive) {
                        this.setAttribute('aria-expanded', 'true');
                        const icon = this.querySelector('.faq-toggle i');
                        icon.style.transform = 'rotate(45deg)';
                    }
                });
            });
        });
    </script>
@endsection
