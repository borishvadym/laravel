<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-header">CONTENT</li>
        <li class="nav-item">
            <a href="{{ route('category') }}" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                    Categories
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('article') }}" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Articles
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('tag') }}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                    Tags
                </p>
            </a>
        </li>
    </ul>
</nav>
