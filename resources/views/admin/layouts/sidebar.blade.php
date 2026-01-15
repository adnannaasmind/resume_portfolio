<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <h2 class="text-white fw-bold">Resume Pro</h2>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Management') }}</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <p>{{ __('Manage Users') }}</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.resumes*') ? 'active' : '' }}">
                    <a href="{{ route('admin.resumes.index') }}">
                        <i class="fas fa-file-invoice"></i>
                        <p>{{ __('My Resume') }}</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.templates*') ? 'active' : '' }}">
                    <a href="{{ route('admin.templates.index') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>{{ __('Templates') }}</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.plans*') ? 'active' : '' }}">
                    <a href="{{ route('admin.plans.index') }}">
                        <i class="fas fa-tags"></i>
                        <p>{{ __('Manage Plans') }}</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.portfolio-templates*') ? 'active' : '' }}">
                    <a href="{{ route('admin.portfolio-templates.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <p>{{ __('Portfolio Templates') }}</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Reports') }}</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.reports.payments') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.payments') }}">
                        <i class="fas fa-dollar-sign"></i>
                        <p>{{ __('Payment Reports') }}</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.reports.users') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.users') }}">
                        <i class="fas fa-chart-bar"></i>
                        <p>{{ __('User Reports') }}</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Configuration') }}</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.settings*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#settings" class="{{ request()->routeIs('admin.settings*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('admin.settings*') ? 'true' : 'false' }}">
                        <i class="fas fa-cog"></i>
                        <p>{{ __('Settings') }}</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.settings*') ? 'show' : '' }}" id="settings">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.settings.system') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.system') }}">
                                    <span class="sub-item">{{ __('System Settings') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.settings.smtp') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.smtp') }}">
                                    <span class="sub-item">{{ __('SMTP Settings') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.settings.payment') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.payment') }}">
                                    <span class="sub-item">{{ __('Payment Settings') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.settings.website') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.website') }}">
                                    <span class="sub-item">{{ __('Website Settings') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.settings.languages*') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.languages') }}">
                                    <span class="sub-item">{{ __('Manage Language') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.settings.seo') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.seo') }}">
                                    <span class="sub-item">{{ __('SEO Settings') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.settings.about') ? 'active' : '' }}">
                                <a href="{{ route('admin.settings.about') }}">
                                    <span class="sub-item">{{ __('About') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-circle"></i>
                        <p>{{ __('Manage Profile') }}</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">{{ __('Quick Links') }}</h4>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-arrow-left"></i>
                        <p>{{ __('Back to User Dashboard') }}</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
