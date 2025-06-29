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
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('child.register.form') }}">
                            <i class="fas fa-user-plus me-1"></i>Register Child
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
                            <i class="fas fa-user me-1"></i>Profile
                        </a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a href="{{ route('logout') }}" class="nav-link" href="logout.html">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>