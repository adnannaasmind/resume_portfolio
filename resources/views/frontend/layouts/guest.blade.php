<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Professional Resume Builder</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-gradient {
            background: linear-gradient(-45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #667eea 100%);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .dark .glassmorphism {
            background: rgba(31, 41, 55, 0.95);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex relative overflow-hidden animate-gradient">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-float"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float"
                style="animation-delay: 4s;"></div>
        </div>

        <!-- Left Panel - Branding & Features -->
        <div class="hidden lg:flex lg:w-1/2 p-12 flex-col justify-between relative z-10">
            <!-- Logo -->
            <div class="animate-fadeInUp">
                <a href="/" class="inline-block">
                    <div class="flex items-center space-x-3 group">
                        <div
                            class="bg-white rounded-xl p-3 shadow-xl group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-3xl font-bold text-white drop-shadow-lg">ResumePro</span>
                    </div>
                </a>
            </div>

            <!-- Main Content -->
            <div class="animate-fadeInUp" style="animation-delay: 0.2s;">
                <div class="max-w-lg">
                    <h1 class="text-5xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                        Craft Your Perfect Resume in Minutes
                    </h1>
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Join over 10,000+ professionals who landed their dream jobs using our AI-powered resume builder.
                    </p>

                    <div class="space-y-5">
                        <div class="flex items-center space-x-4 group">
                            <div
                                class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-full p-3 group-hover:bg-white/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-lg text-white font-medium">10+ Premium Templates</span>
                        </div>
                        <div class="flex items-center space-x-4 group">
                            <div
                                class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-full p-3 group-hover:bg-white/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-lg text-white font-medium">AI-Powered Cover Letters</span>
                        </div>
                        <div class="flex items-center space-x-4 group">
                            <div
                                class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-full p-3 group-hover:bg-white/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-lg text-white font-medium">One-Click PDF Export</span>
                        </div>
                        <div class="flex items-center space-x-4 group">
                            <div
                                class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-full p-3 group-hover:bg-white/30 transition-all duration-300 group-hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-lg text-white font-medium">Portfolio & Analytics</span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-1">10K+</div>
                            <div class="text-sm text-white/80">Active Users</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-1">50K+</div>
                            <div class="text-sm text-white/80">Resumes Created</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-1">95%</div>
                            <div class="text-sm text-white/80">Success Rate</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-white/70 text-sm animate-fadeInUp" style="animation-delay: 0.4s;">
                <p>&copy; {{ date('Y') }} ResumePro. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Panel - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-8 relative z-10">
            <div class="w-full max-w-md animate-fadeInUp" style="animation-delay: 0.3s;">
                <!-- Mobile Logo -->
                <div class="lg:hidden mb-8 text-center">
                    <a href="/" class="inline-flex items-center space-x-3">
                        <div class="bg-white rounded-xl p-2.5 shadow-xl">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white">ResumePro</span>
                    </a>
                </div>

                <!-- Form Card -->
                <div class="glassmorphism rounded-3xl shadow-2xl p-8 sm:p-10 border border-white/20">
                    {{ $slot }}
                </div>

                <!-- Footer Links -->
                <div class="mt-8 text-center">
                    <div class="flex items-center justify-center space-x-6 text-sm text-white/80">
                        <a href="{{ route('pricing') }}" class="hover:text-white transition font-medium">Pricing</a>
                        <span>•</span>
                        <a href="{{ route('templates.index') }}"
                            class="hover:text-white transition font-medium">Templates</a>
                        <span>•</span>
                        <a href="/" class="hover:text-white transition font-medium">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>