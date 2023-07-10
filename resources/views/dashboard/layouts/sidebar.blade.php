<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
                </li>
                <li class="menu-title">Fitur</li><!-- /.menu-title -->
                <li class="{{ Request::is('dashboard/cabang*') ? 'active' : '' }}">
                    <a href="/dashboard/cabang"> <i class="menu-icon fa fa-map-marker"></i>Cabang </a>
                </li>
                <li class="{{ Request::is('dashboard/service*') ? 'active' : '' }}">
                    <a href="/dashboard/service"> <i class="menu-icon fa fa-tasks"></i>Services </a>
                </li>
                <li class="{{ Request::is('dashboard/karyawan*') ? 'active' : '' }}">
                    <a href="/dashboard/karyawan"> <i class="menu-icon fa fa-tasks"></i>Karyawan </a>
                </li>

                <li class="menu-title">Logout</li><!-- /.menu-title -->
                <li>
                    <a href="/logout"> <i class="menu-icon fa fa-sign-out"></i>Logout</a>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
