<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand text-decoration-none" href="#0">
        <span class="align-middle">Raveloux Surabaya</span>
     </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
            </li>

            @can('admin')
                <li class="sidebar-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('users') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span></a>
                </li>
                <li class="sidebar-item {{ Request::is('clients*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('clients') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Clients</span></a>
                </li>
                <li class="sidebar-item {{ Request::is('projects*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('projects') }}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Projects</span></a>
                </li>
            @endcan
                <li class="sidebar-item {{ Request::is('tasks*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('tasks') }}">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tasks</span></a>
                </li>                


            <li class="sidebar-header">
                Authentication
            </li>

            <li class="sidebar-item {{ Request::is('settings*') ? 'active' : '' }}">
                <a class="sidebar-link" href="#">
                <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Reset Password</span></a>
            </li> 

            <li class="sidebar-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link border-0"><i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Log out</span></button>
                </form>
            </li>
            
        </ul>

    </div>
</nav>