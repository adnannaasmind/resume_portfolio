<!-- Sidebar -->
<div class="sidebar">
    <div class="profile-section">
        <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&size=120&background=1a1a1a&color=fff' }}"
            alt="{{ auth()->user()->name }}" class="profile-img">
        <h3 class="profile-name">{{ auth()->user()->name }}</h3>
        <p class="profile-tagline">Hi, I'm {{ auth()->user()->name }}. Welcome to my personal website!</p>

        <div class="social-icons">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>

    <nav class="nav-menu">
        <div class="nav-item-custom">
            <a href="#" class="nav-link-custom active">
                <i class="fas fa-user"></i> About Me
            </a>
        </div>
        <div class="nav-item-custom">
            <a href="#" class="nav-link-custom">
                <i class="fas fa-briefcase"></i> Portfolio
            </a>
        </div>
        <div class="nav-item-custom">
            <a href="#" class="nav-link-custom">
                <i class="fas fa-clipboard-list"></i> Services & Pricing
            </a>
        </div>
        <div class="nav-item-custom">
            <a href="#" class="nav-link-custom">
                <i class="fas fa-file-alt"></i> Resume
            </a>
        </div>
        <div class="nav-item-custom">
            <a href="#" class="nav-link-custom">
                <i class="fas fa-blog"></i> Blog
            </a>
        </div>
        <div class="nav-item-custom">
            <a href="#" class="nav-link-custom">
                <i class="fas fa-envelope"></i> Contact
            </a>
        </div>
        <div class="nav-item-custom">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <a href="#" class="nav-link-custom"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </div>
    </nav>

    <button class="hire-btn">
        <i class="fas fa-paper-plane"></i> Hire Me
    </button>
</div>