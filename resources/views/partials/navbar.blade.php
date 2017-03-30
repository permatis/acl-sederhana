<header class="main-header">
    <a href="{{ URL::to('/') }}" class="logo">
        <span class="logo-mini"><b>TM</b></span>
        <span class="logo-lg"><b>Task</b> Management</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        @if(! auth()->guest() )
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        @endif
        <div class="container-fluid">
            <div class="navbar-custom-menu">
                <div class="collapse navbar-collapse" id="navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle profile-menu" alt="{{ Auth::user()->name }}">
                                    {{ Auth::user()->name }}
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </nav>
</header>
