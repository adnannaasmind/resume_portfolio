<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simon Doe - Portfolio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, #2ecc71 0%, #27ae60 100%);
            padding: 40px 30px;
            color: white;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 20px;
            object-fit: cover;
        }

        .profile-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .profile-tagline {
            font-size: 13px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
        }

        .social-icons a {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .nav-menu {
            margin-top: 40px;
        }

        .nav-item-custom {
            margin-bottom: 8px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            font-size: 14px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .nav-link-custom i {
            margin-right: 12px;
            width: 18px;
        }

        .hire-btn {
            width: 100%;
            padding: 14px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 30px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .hire-btn:hover {
            background: white;
            color: #2ecc71;
        }

        .main-content {
            margin-left: 280px;
            padding: 60px 80px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 60px;
            gap: 40px;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1a1a1a;
        }

        .header-text h2 {
            font-size: 20px;
            color: #666;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .header-text p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .header-text a {
            color: #2ecc71;
            text-decoration: none;
            font-weight: 500;
        }

        .header-text a:hover {
            text-decoration: underline;
        }

        .header-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-primary-custom {
            padding: 12px 30px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-custom:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            padding: 12px 30px;
            background: #333;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary-custom:hover {
            background: #1a1a1a;
            transform: translateY(-2px);
        }

        .header-image {
            width: 350px;
            height: 300px;
            background: #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
        }

        .header-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1a1a1a;
            padding-left: 20px;
            border-left: 4px solid #2ecc71;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 40px;
            padding-left: 24px;
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .skill-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .skill-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .skill-icon {
            width: 50px;
            height: 50px;
            background: #fff3cd;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .skill-card:nth-child(2) .skill-icon {
            background: #ffe0e0;
        }

        .skill-card:nth-child(3) .skill-icon {
            background: #e0f7e0;
        }

        .skill-card:nth-child(4) .skill-icon {
            background: #e0e7ff;
        }

        .skill-card:nth-child(5) .skill-icon {
            background: #ffe0f0;
        }

        .skill-card:nth-child(6) .skill-icon {
            background: #fff0e0;
        }

        .skill-card:nth-child(7) .skill-icon {
            background: #e0f0ff;
        }

        .skill-card:nth-child(8) .skill-icon {
            background: #f0e0ff;
        }

        .skill-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .skill-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .skill-experience {
            color: #999;
            font-size: 13px;
        }

        .skill-logos {
            display: flex;
            gap: 8px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .skill-logo {
            padding: 4px 10px;
            background: #f5f5f5;
            border-radius: 4px;
            font-size: 12px;
            color: #666;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 240px;
            }

            .main-content {
                margin-left: 240px;
                padding: 40px;
            }

            .header-section {
                flex-direction: column-reverse;
            }

            .header-image {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
                padding: 30px 20px;
            }

            .header-text h1 {
                font-size: 36px;
            }

            .skills-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>