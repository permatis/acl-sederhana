<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @if(request()->segment(1) == 'dashboard') class="active" @endif>
                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li @if(request()->segment(1) == 'tasks') class="active" @endif>
                <a href="{{ url('tasks') }}"><i class="fa fa-calendar"></i><span>Tasks</span></a>
            </li>
            <li @if(request()->segment(1) == 'roles') class="active" @endif>
                <a href="{{ url('roles') }}"><i class="fa fa-sitemap"></i><span>Roles</span></a>
            </li>
            <li @if(request()->segment(1) == 'permissions') class="active" @endif>
                <a href="{{ url('permissions') }}"><i class="fa fa-random"></i><span>Permissions</span></a>
            </li>
            <li @if(request()->segment(1) == 'users') class="active" @endif>
                <a href="{{ url('users') }}"><i class="fa fa-group"></i><span>Users</span></a>
            </li>
        </ul>
    </section>
</aside>
