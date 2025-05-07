<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="{{ url('/dashboard') }}" class="logo logo-normal">
            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="">
        </a>
        <a href="{{ url('/dashboard') }}" class="logo logo-white">
            <img src="{{ URL::asset('/build/img/logo.png') }}" alt="">
        </a>
        <a href="{{ url('/dashboard') }}" class="logo-small">
            <img src="{{ URL::asset('/build/img/favicon.png') }}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Search -->
        <li class="nav-item nav-searchinputs">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </li>
        <!-- /Search -->

        <li class="nav-item nav-item-box">
            <a href="javascript:void(0);" id="btnFullscreen">
                <i data-feather="maximize"></i>
            </a>
        </li>

        <!-- Paramètres -->
<li class="nav-item nav-item-box">
    <a href="{{ url('/chat') }}"><i data-feather="message-circle"></i></a>
</li>

        <!-- Dropdown utilisateur -->
         
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="nav-link dropdown-toggle userset" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="user-info">
                   
                    <span class="user-detail">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{ url('profile') }}">
                        <i class="me-2" data-feather="user"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="{{ url('/chat') }}">
                        <i class="me-2" data-feather="message-square"></i> Chat
                    </a>
                    <hr class="m-0">
                    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a class="dropdown-item logout pb-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
        <img src="{{ URL::asset('/build/img/icons/log-out.svg') }}" class="me-2" alt="img"> Logout
    </a>
</form>

                </div>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ url('profile') }}">My Profile</a>
            <a class="dropdown-item" href="{{ url('/chat') }}">Chat</a>
            <a class="dropdown-item" href="{{ url('signin') }}">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
<!-- /Header -->

<!-- Bootstrap 5 JS (à mettre juste avant </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
