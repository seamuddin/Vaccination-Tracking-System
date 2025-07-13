<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a href="{{ route('guardianPortfolio') }}" class="navbar-brand">
                <i class="fas fa-syringe me-2"></i>VaxTracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('guardianPortfolio') }}">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guardian.child.list') }}">
                            <i class="fa-solid fa-children me-1"></i>
                            My Children
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="notifications.html">
                            <i class="fas fa-bell me-1"></i>Notifications
                            <span class="notification-badge">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guardian.profile') }}">
                            <i class="fa-solid fa-calendar-check me-1"></i>
                            Appointments
                        </a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <div class="user-menu">
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                        </div>
                        
                        <div class="dropdown" id="userDropdown">
                            @if (!empty(Auth::user()->image))
                                <div class="avatar avatar-online" onclick="toggleDropdown()">
                                    <img src="{{ url(Auth::user()->image) }}"
                                        alt class="w-px-40 h-auto rounded-circle"/>
                                </div>
                            @else
                                <div class="user-avatar" onclick="toggleDropdown()">
                                    {{ strtoupper(substr(trim(Auth::user()->name), 0, 1)) }}
                                </div>
                            @endif
                            <!-- Simple Dropdown Menu -->
                            <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                                <!-- User Info Header -->
                                <div class="dropdown-header">
                                    <div class="dropdown-user-info">
                                        <div class="dropdown-user-name">{{ Auth::user()->name }}</div>
                                        <div class="dropdown-user-email">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <!-- Simple Menu Items -->
                                <div class="dropdown-content">
                                    <a href="{{ route('guardian.profile') }}" class="dropdown-item">
                                        <i class="fas fa-user dropdown-icon"></i>
                                        <span class="dropdown-text">My Profile</span>
                                    </a>
                                    
                                    <a href="{{ route('logout') }}" class="dropdown-item danger">
                                        <i class="fas fa-sign-out-alt dropdown-icon"></i>
                                        <span class="dropdown-text">Logout</span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function toggleDropdown() {
            var menu = document.getElementById('dropdownMenu');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
        // Optional: Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById('userDropdown');
            var menu = document.getElementById('dropdownMenu');
            if (!dropdown.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>