<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gesigan Jeevee May - CV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            display: flex;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            min-height: 100vh;
        }

        /* Left Sidebar */
        .sidebar {
            width: 35%;
            background-color: #fafafa;
            padding: 50px 40px;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            margin: 0 auto 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 72px;
            color: white;
            font-weight: bold;
        }

        .name {
            margin-bottom: 30px;
        }

        .name h1 {
            font-size: 42px;
            color: #2196F3;
            font-weight: 700;
            line-height: 1.2;
        }

        .job-title {
            color: #999;
            font-size: 18px;
            margin-top: 10px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title svg {
            width: 24px;
            height: 24px;
            color: #666;
        }

        .section-title h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .edit-icon {
            width: 20px;
            height: 20px;
            color: #2196F3;
            cursor: pointer;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: #666;
            font-size: 14px;
        }

        .contact-item svg {
            width: 18px;
            height: 18px;
        }

        .about-text {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .skills-list {
            list-style: none;
        }

        .skills-list li {
            color: #666;
            font-size: 15px;
            margin-bottom: 10px;
            padding-left: 20px;
            position: relative;
        }

        .skills-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2196F3;
        }

        /* Right Content */
        .content {
            width: 65%;
            padding: 50px 60px;
            background: white;
        }

        .toolbar {
            background: #2196F3;
            padding: 15px 20px;
            margin: -50px -60px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }

        .toolbar-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .content-section {
            margin-bottom: 50px;
        }

        .content-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            background: #f0f8ff;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .content-section-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .content-section-title svg {
            width: 28px;
            height: 28px;
            color: #666;
        }

        .content-section-title h2 {
            font-size: 26px;
            font-weight: 600;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 35px;
        }

        .timeline-item:before {
            content: "";
            position: absolute;
            left: 4px;
            top: 8px;
            width: 10px;
            height: 10px;
            background: #2196F3;
            border-radius: 50%;
        }

        .timeline-item:after {
            content: "";
            position: absolute;
            left: 8px;
            top: 18px;
            width: 2px;
            height: calc(100% + 20px);
            background: #e0e0e0;
        }

        .timeline-item:last-child:after {
            display: none;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .item-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-subtitle {
            color: #666;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .item-date {
            background: #f5f5f5;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .item-description {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
        }

        .references-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .reference-card {
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        .reference-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .reference-title {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .reference-contact {
            color: #666;
            font-size: 13px;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <div class="profile-img">GJ</div>

            <div class="name">
                <h1>Gesigan</h1>
                <h1>Jeevee May</h1>
                <p class="job-title">Marketing Manager</p>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <h2>Contact</h2>
                    </div>
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>+087948759327987</span>
                </div>
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>gesigan@gmail.com</span>
                </div>
                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>123 Anywhere St. Any City ST 1213</span>
                </div>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h2>About Me</h2>
                    </div>
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <p class="about-text">Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
                <p class="about-text">Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                        <h2>Skills</h2>
                    </div>
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <ul class="skills-list">
                    <li>Management Skills</li>
                    <li>Creativity</li>
                    <li>Digital Marketing</li>
                    <li>Negotiation</li>
                    <li>Critical Thinking</li>
                    <li>Critical Thinking</li>
                    <li>Critical Thinking</li>
                </ul>
            </div>
        </div>

        <!-- Right Content -->
        <div class="content">
            <div class="toolbar">
                <button class="toolbar-btn">Manrope ▼</button>
                <button class="toolbar-btn">− 12 +</button>
                <button class="toolbar-btn">T</button>
                <button class="toolbar-btn">B I U</button>
                <button class="toolbar-btn">≡ 1.5 ▼</button>
                <button class="toolbar-btn">⊟ 1 ▼</button>
                <button class="toolbar-btn">☰</button>
            </div>

            <div class="content-section">
                <div class="content-section-header">
                    <div class="content-section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <h2>Education</h2>
                    </div>
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>

                <div class="timeline-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">Bachelor of Business Management</div>
                            <div class="item-subtitle">Barcelle University</div>
                        </div>
                        <div class="item-date">2016-2020</div>
                    </div>
                    <p class="item-description">Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
                </div>

                <div class="timeline-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">Bachelor of Business Management</div>
                            <div class="item-subtitle">Barcelle University</div>
                        </div>
                        <div class="item-date">2016-2020</div>
                    </div>
                    <p class="item-description">Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
                </div>
            </div>

            <div class="content-section">
                <div class="content-section-header">
                    <div class="content-section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <h2>Experience</h2>
                    </div>
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>

                <div class="timeline-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">Product Design Manager</div>
                            <div class="item-subtitle">Arovwai Industries</div>
                        </div>
                        <div class="item-date">2016-2020</div>
                    </div>
                    <p class="item-description">Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
                </div>

                <div class="timeline-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">Marketing Manager</div>
                            <div class="item-subtitle">Arovwai Industries</div>
                        </div>
                        <div class="item-date">2019-2020</div>
                    </div>
                    <p class="item-description">Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
                </div>

                <div class="timeline-item">
                    <div class="item-header">
                        <div>
                            <div class="item-title">Marketing Manager</div>
                            <div class="item-subtitle">Arovwai Industries</div>
                        </div>
                        <div class="item-date">2019-2020</div>
                    </div>
                    <p class="item-description">Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor. Sed eget placerat habitant mauris neque habitasse. Lorem ipsum dolor sit amet consectetur. Erat ut ut pellentesque mauris varius tempor.</p>
                </div>
            </div>

            <div class="content-section">
                <div class="content-section-header">
                    <div class="content-section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <h2>References</h2>
                    </div>
                    <svg class="edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>

                <div class="references-grid">
                    <div class="reference-card">
                        <div class="reference-name">Harumi Kobyashi</div>
                        <div class="reference-title">Wadiere Inc. /CEO</div>
                        <div class="reference-contact">Phone : 0346875925</div>
                        <div class="reference-contact">Email : harumikoby@email.com</div>
                    </div>
                    <div class="reference-card">
                        <div class="reference-name">Harumi Kobyashi</div>
                        <div class="reference-title">Wadiere Inc. /CEO</div>
                        <div class="reference-contact">Phone : 0346875925</div>
                        <div class="reference-contact">Email : harumikoby@email.com</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
