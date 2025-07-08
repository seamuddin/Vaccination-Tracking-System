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
                            <i class="fas fa-user-plus me-1"></i>My Children
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
                    <div class="user-menu">
                        <div class="user-info">
                            <div class="user-name">Fatima Rahman</div>
                            <div class="user-role">Parent Account</div>
                        </div>
                        
                        <div class="dropdown" id="userDropdown">
                            <div class="user-avatar" onclick="toggleDropdown()">
                                FR
                            </div>
                            
                            <!-- Simple Dropdown Menu -->
                            <div class="dropdown-menu">
                                <!-- User Info Header -->
                                <div class="dropdown-header">
                                    <div class="dropdown-avatar">FR</div>
                                    <div class="dropdown-user-info">
                                        <div class="dropdown-user-name">Fatima Rahman</div>
                                        <div class="dropdown-user-email">fatima.rahman@email.com</div>
                                    </div>
                                </div>

                                <!-- Simple Menu Items -->
                                <div class="dropdown-content">
                                    <a href="#" class="dropdown-item" onclick="goToProfile()">
                                        <i class="fas fa-user dropdown-icon"></i>
                                        <span class="dropdown-text">My Profile</span>
                                    </a>
                                    
                                    <a href="#" class="dropdown-item danger" onclick="logout()">
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