@extends('frontend.dashboard.layouts.master')

@section('title')
@endsection

@include('frontend.dashboard.layouts.sidebar')

<div class="main-content">
<!-- Header Section -->
    <div class="header-section">
        <div class="header-text">
            <h1>Simon Doe</h1>
            <h2>Senior Software Engineer</h2>
            <p>I'm a software engineer specialized in frontend and backend development for complex scalable web
                apps. I write about software development on <a href="#">my blog</a>. Want to know how I may help
                your project? Check out my project <a href="#">portfolio</a> and <a href="#">online resume</a>.</p>

            <div class="header-buttons">
                <button class="btn-primary-custom">
                    <i class="fas fa-file-download"></i> View Portfolio
                </button>
                <button class="btn-secondary-custom">
                    <i class="fab fa-github"></i> View on Github
                </button>
            </div>
        </div>

        <div class="header-image">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=350&fit=crop" alt="Profile">
        </div>
    </div>

    <!-- What I Do Section -->
    <div class="what-i-do-section">
        <h2 class="section-title">What I do</h2>
        <p class="section-subtitle">I have more than 10 years' experience building software for clients all over the
            world. Below is a quick overview of my main technical skills and technologies I use. Want to find out
            more about my experience? Check out my <a href="#" style="color: #2ecc71; text-decoration: none;">online
                resume</a> and <a href="#" style="color: #2ecc71; text-decoration: none;">project portfolio</a>.</p>

        <div class="skills-grid">
            <!-- JavaScript -->
            <div class="skill-card">
                <div class="skill-icon">📦</div>
                <h3 class="skill-title">Vanilla JavaScript</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 5 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">JavaScript</span>
                    <span class="skill-logo">jQuery</span>
                </div>
            </div>

            <!-- Angular, React & Vue -->
            <div class="skill-card">
                <div class="skill-icon">🏠</div>
                <h3 class="skill-title">Angular, React & Vue</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 3 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">Angular</span>
                    <span class="skill-logo">React</span>
                    <span class="skill-logo">Vue</span>
                </div>
            </div>

            <!-- Node.js -->
            <div class="skill-card">
                <div class="skill-icon">🌐</div>
                <h3 class="skill-title">Node.js</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 2 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">Node.js</span>
                    <span class="skill-logo">Express</span>
                </div>
            </div>

            <!-- Python & Django -->
            <div class="skill-card">
                <div class="skill-icon">🐍</div>
                <h3 class="skill-title">Python & Django</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 4 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">Python</span>
                    <span class="skill-logo">Django</span>
                </div>
            </div>

            <!-- PHP -->
            <div class="skill-card">
                <div class="skill-icon">🐘</div>
                <h3 class="skill-title">PHP</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 5 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">PHP</span>
                    <span class="skill-logo">Laravel</span>
                </div>
            </div>

            <!-- HTML, CSS & GRUNT -->
            <div class="skill-card">
                <div class="skill-icon">💻</div>
                <h3 class="skill-title">HTML, CSS & Grunt</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 5 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">HTML5</span>
                    <span class="skill-logo">CSS3</span>
                </div>
            </div>

            <!-- HTML & CSS -->
            <div class="skill-card">
                <div class="skill-icon">📱</div>
                <h3 class="skill-title">HTML & CSS</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 5 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">HTML5</span>
                    <span class="skill-logo">CSS3</span>
                </div>
            </div>

            <!-- Sass & LESS -->
            <div class="skill-card">
                <div class="skill-icon">🎨</div>
                <h3 class="skill-title">Sass & LESS</h3>
                <p class="skill-description">List skills/technologies here. You can change the icon above to any of
                    the 1500+ FontAwesome 5 free icons available.</p>
                <p class="skill-experience">1000+ Experience: 3 Years</p>
                <div class="skill-logos">
                    <span class="skill-logo">Sass</span>
                    <span class="skill-logo">LESS</span>
                </div>
            </div>
        </div>
    </div>
</div>
