<!-- ? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="assets/img/logo/loder.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<header>
    <!--? Header Start -->
    <div class="header-area header-transparent pt-20">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a href="/"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="menu-main d-flex align-items-center justify-content-end">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a>
                                        </li>
                                        <li class="{{ Request::is('about') ? 'active' : '' }}"><a
                                                href="/about">About</a>
                                        </li>
                                        <li><a href="services.html" class="">Services</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        @auth
                                            <li><a href="blog.html">{{ auth()->user()->email }}</a>
                                                <ul class="submenu">
                                                    <li><a href="/dashboard">My Dashboard</a></li>
                                                    <li><a href="/logout">Logout</a></li>
                                                </ul>
                                            </li>
                                            {{-- <ul class="navbar-nav ms-auto">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Selamat Datang, {{ auth()->user()->name }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="/dashboard">My Dashboard</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="/logout" method="post">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">Logout</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul> --}}
                                        @else
                                            <a href="/registrasi" class="btn header-btn">Registrasi</a>
                                            <a href="/login" class="btn header-btn">Login</a>
                                        @endauth
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
