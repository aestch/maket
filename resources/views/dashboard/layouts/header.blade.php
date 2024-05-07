<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                    <img src="/img/logo-maket-panjang.png" alt="homepage" class="dark-logo w-75 " />
             
                <!--End Logo icon -->
                <!-- Logo text -->
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li>
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle mx-2 p-2 mt-3" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle " > {{ auth()->user()->username }} </i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Log-Out</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type='submit'" class="btn btn-secondary p-2 mt-3">Log-Out <i class="bi bi-box-arrow-right"></i></button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>