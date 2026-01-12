<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <h2 class="text-white fw-bold">ResumePro Admin</h2>
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
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Management</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <a href="{{ route('admin.users') }}">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.templates') ? 'active' : '' }}">
                    <a href="{{ route('admin.templates') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>Resume Templates</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.plans') ? 'active' : '' }}">
                    <a href="{{ route('admin.plans') }}">
                        <i class="fas fa-tags"></i>
                        <p>Pricing Plans</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Configuration</h4>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}">
                        <i class="fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Quick Links</h4>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-arrow-left"></i>
                        <p>Back to User Dashboard</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>