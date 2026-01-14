<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">ResumePro</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Templates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>

                <!-- Login -->
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">
                        Login
                    </a>
                </li>

                <!-- Signup -->
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-primary" href="{{ route('register') }}">
                        Sign Up
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- HEADER -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h1 class="fw-bold">Explore Professional Portfolios</h1>
        <p class="text-muted mt-2">
            Discover resumes and portfolios created by professionals
        </p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control form-control-lg"
                    placeholder="Search by name, skill, or role...">
            </div>
        </div>
    </div>
</section>
