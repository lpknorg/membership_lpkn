<nav class="navbar navbar-expand-lg navbar-dark bg_nav nav_all">
    <div class="container con_full" id="dancee">
        <a href="{{url('/')}}" class="navbar-brand">
            <img src="{{asset('frontend/images/logo_putih.png')}}" alt="LPKN Logo" class="brand-image">
        </a>
        <?php
        $routes = \Route::currentRouteName();
            // dd($routes);
        ?>
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item">
                <a href="{{route('welcome')}}" class="nav-link {{$routes == 'welcome' ? 'active' : ''}}">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{route('allevent', ['id' => 1])}}" class="nav-link {{$routes == 'allevent' ? 'active' : ''}}">Event</a>
            </li>
            <li class="nav-item">
                <a href="https://ilmu.lpkn.id/" class="nav-link">Berita</a>
            </li>
            <li class="nav-item">
                <a href="{{route('allvideo')}}" class="nav-link {{$routes == 'allvideo' ? 'active' : ''}}">Video</a>
            </li>
            <li class="nav-item">
                <a href="{{route('peraturan')}}" class="nav-link {{$routes == 'peraturan' ? 'active' : ''}}">Peraturan</a>
            </li>
            <li class="nav-item">
                <a href="{{route('artikel.index')}}" class="nav-link {{$routes == 'artikel.index' || $routes == 'artikel.detail' || $routes == 'artikel.indexProfile' ? 'active' : ''}}">Artikel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('downloadFile', ['file' => 'manual-book.pdf', 'folder' => 'modul'])}}">Download Manual Book</a>
            </li>
            @if(\Auth::check())
            <div class="dropdown-divider"></div>
            <div class="d-block d-md-none">
                <li class="nav-item">
                    <a href="{{route('member_profile.edit_profile')}}" class="nav-link {{$routes == 'member_profile.edit_profile' ? 'active' : ''}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('artikel.indexProfile', ['uname' => \Helper::getUname(\Auth::user())])}}" class="nav-link {{$routes == 'artikel.indexProfile' || $routes == 'artikel.detail' || $routes == 'artikel.indexProfile' ? 'active' : ''}}">Artikel Saya</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('member_profile.edit_password')}}" class="nav-link {{$routes == 'member_profile.edit_password' ? 'active' : ''}}">Ubah Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </div>
            @endif
        </ul>
        <div class="navbar-toggler border-0 ml-auto mr-2" data-toggle="collapse" data-target="#dropNavbar1" aria-controls="dropNavbar1" aria-expanded="false" aria-label="Toggle navigation">
            <div class="position-relative">
                <i class="fa-solid fa-bell" style="font-size: 20px;"></i>
                <span class="position-absolute notif-number py-1">6</span>
            </div>
        </div>
        @if(\Auth::check() && \Auth::user()->member)
        <img class="in_nav navbar-toggler" data-toggle="collapse" data-target="#dropNavbar" aria-controls="dropNavbar" aria-expanded="false" aria-label="Toggle navigation" src="{{\Helper::showImage(\Auth::user()->member->foto_profile, 'poto_profile')}}" alt="User profile picture" style="width:40px;height:40px;border-radius:50%;padding:0px">
        @else
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#dropNavbar" aria-controls="dropNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @endif
        <?php
        $routes = \Route::currentRouteName();
            // dd($routes);
        ?>
        <div class="collapse navbar-collapse" id="dropNavbar1" data-parent="#dancee">
            <div class="d-block d-lg-none">
                <div class="dropdown-divider m-0"></div>
                <a href="" class="dropdown-item notif_before_read">
                    <span>asdasd asd asd asdasdsdsad asdas dasd</span> <br>
                    <p class="m-0 text-right small">2023-08-14 13:48:09</p>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="" class="dropdown-item notif_before_read">
                    <span>Ini belum dibaca</span> <br>
                    <p class="m-0 text-right small">2023-08-14 13:48:09</p>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="" class="dropdown-item notif_before_read">
                    <span>Ini belum dibaca</span> <br>
                    <p class="m-0 text-right small">2023-08-14 13:48:09</p>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="" class="dropdown-item">
                    <span>Ini belum dibaca</span> <br>
                    <p class="m-0 text-right small">2023-08-14 13:48:09</p>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="" class="dropdown-item">
                    <span>Ini sudah dibaca</span> <br>
                    <p class="m-0 text-right small">2023-08-14 13:48:09</p>
                </a>
                <div class="dropdown-divider mt-0"></div>
                <a href="{{route('notification')}}" class="dropdown-item text-center">
                    Lihat Semua
                </a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="dropNavbar" data-parent="#dancee">
            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                    <a href="{{route('welcome')}}" class="nav-link {{$routes == 'welcome' ? 'active' : ''}}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allevent', ['id' => 1])}}" class="nav-link {{$routes == 'allevent' ? 'active' : ''}}">Event</a>
                </li>
                <li class="nav-item">
                    <a href="https://ilmu.lpkn.id/" class="nav-link">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allvideo')}}" class="nav-link {{$routes == 'allvideo' ? 'active' : ''}}">Video</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('peraturan')}}" class="nav-link {{$routes == 'peraturan' ? 'active' : ''}}">Peraturan</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('artikel.index')}}" class="nav-link {{$routes == 'artikel.index' || $routes == 'artikel.detail' || $routes == 'artikel.indexProfile' ? 'active' : ''}}">Artikel</a>
                </li>
                @if(\Auth::check())
                <div class="dropdown-divider"></div>
                <div class="d-block d-lg-none">
                    <li class="nav-item">
                        <a href="{{route('member_profile.edit_profile')}}" class="nav-link {{$routes == 'member_profile.edit_profile' ? 'active' : ''}}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('artikel.indexProfile', ['uname' => \Helper::getUname(\Auth::user())])}}" class="nav-link {{$routes == 'artikel.indexProfile' || $routes == 'artikel.detail' || $routes == 'artikel.indexProfile' ? 'active' : ''}}">Artikel Saya</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('member_profile.edit_password')}}" class="nav-link {{$routes == 'member_profile.edit_password' ? 'active' : ''}}">Ubah Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </div>                    
                @endif

            </ul>
            @if(\Auth::check())
            <ul class="navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                
                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link m-0 p-0 out_nav" data-toggle="dropdown" href="#">
                        @if(\Auth::user()->member)
                        <img class="in_nav" src="{{\Helper::showImage(\Auth::user()->member->foto_profile, 'poto_profile')}}" alt="User profile picture" style="width:40px;height:40px;border-radius:50%;">
                        @else
                        <img class="in_nav" src="{{asset('default.png')}}" alt="User profile picture" style="width:40px;height:40px;border-radius:50%;">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
                        <span class="dropdown-header" style="padding: 0rem 1.5rem;">
                            <h5>{{\Auth::user()->name}}</h5>
                        </span>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('member_profile.edit_profile')}}" class="dropdown-item">
                            <i class="fa fa-user mr-2"></i> Profile
                        </a>
                        <a href="{{route('artikel.indexProfile', ['uname' => \Helper::getUname(\Auth::user())])}}" class="dropdown-item">
                            <i class="fa-regular fa-newspaper mr-2"></i> Artikel Saya
                        </a>
                        <a href="{{route('member_profile.edit_password')}}" class="dropdown-item">
                            <i class="fa fa-key mr-2"></i> Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            @else
            <div class="row d-row d-md-none mb-2">
                <div class="col-6 pr-1">
                    <a href="{{route('register')}}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-list mr-2"></i> Daftar</a>
                </div>
                <div class="col-6 pl-1">
                    <a href="{{route('login')}}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-sign-in-alt mr-2"></i> Login</a>
                </div>
            </div>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto d-none d-md-block">
                <li class="nav-item dropdown">
                    <a class="nav-link" style="padding-top: 0.1rem;" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-plus" style="font-size: 25px;"></i>
                        <span class="badge badge-danger navbar-badge" style="right: 2px; top: 2px;">Member</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
                        <a href="{{route('login')}}" class="dropdown-item">
                            <i class="fa fa-sign-in-alt mr-2"></i> Login
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('register')}}" class="dropdown-item">
                            <i class="fa fa-list mr-2"></i> Daftar
                        </a>
                    </div>
                </li>
            </ul>
            @endif
        </div>
    </div>
</nav>
<div class="space-md"></div>
