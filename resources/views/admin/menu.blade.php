<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a style="cursor: pointer; font-size: 20px;" href="{{ url('admin/dashboard') }}"><img height="45" style="background-color: white; padding: 4px; border-radius: 5px;" src="/ressources/logo-homedoc-moyen.png"></a>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="{{ url('admin/dashboard') }}">Docteurs</a>
                <a href="{{ url('admin/patient') }}">Patients</a>
                <a href="{{ url('admin/stats') }}">Statistiques</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('admin/login') }}">Logout</a>
                        </li>
                       <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Page</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
</div>
