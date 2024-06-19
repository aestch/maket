<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/kurir/dashboard">
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
                <li>
                    <nav class="navbar">
                        <form method="POST" action="{{ route('search.perform') }}" class="search-form">
                          @csrf
                          <input class="form-control" style="border: none;" type="search" id="query" name="query" placeholder="Cari Paket Anda disini...." value="{{ isset($query) ? $query : '' }}">
                          <button type="submit" for="query" class="fa fa-search" id="searchbtn"></button>
                        </form>
                      </nav>
                </li>
                
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="btn btn-dark only-icon" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>