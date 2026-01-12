<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        User Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.settings') }}">
                        Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Help
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright">
            {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> for
            <strong>ResumePro</strong>
        </div>
        <div>
            Version 1.0.0
        </div>
    </div>
</footer>