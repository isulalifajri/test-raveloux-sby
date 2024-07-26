<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i> </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">{{ $unreadCount }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown" style="min-width: 20rem !important">
                    <div class="dropdown-menu-header">
                        {{ $unreadCount }} New Notifications
                    </div>
                    <div class="list-group">
                        @foreach ($notifications as $notification)
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-primary" data-feather="bell"></i>
                                    </div>
                                    <div class="col-10">
                                        <div class="text-dark">{{ $notification->data['text_title'] }}</div>
                                        <div class="text-muted small mt-1">{{ $notification->data['messages'] }}</div>
                                        @if(!$notification->read())
                                            <h6 class="small text-info">Belum dibaca</h6>
                                        @else
                                            <h6 class="small text-success">Sudah dibaca</h6>
                                        @endif
                                        <div class="mt-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                @if(!$notification->read())
                                                <form action="{{ route('mark-as-read', $notification->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn text-link p-0" style="color:blue;font-size: 13px;"><b>Tandai Sudah dibaca</b></button>
                                                </form>
                                                @endif
                                                <div class="text-muted small mt-1">{{$notification->created_at->diffForHumans()}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="{{ route('notifications.index') }}" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
                    </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('asset/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Reset Password</a>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="POST">
                        @csrf
                          <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> Log out</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>