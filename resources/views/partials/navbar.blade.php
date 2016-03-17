<header class="main-header">
    <a href="{{ URL::to('/a') }}" class="logo">
        <span class="logo-mini"><b>TM</b></span>
        <span class="logo-lg"><b>Task</b> Management</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="container-fluid">
            <div class="navbar-custom-menu">
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li><a href="#">Link</a></li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                
                                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle profile-menu" alt="
                                Administrator">
                                Administrator
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Setting Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ URL::to('/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>