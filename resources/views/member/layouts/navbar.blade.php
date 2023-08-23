<style>
    .pa {
       max-width: inherit;
       max-height: inherit;
       height: inherit;
       width: inherit;
       object-fit: cover;
       border-radius: 20px;
       height: 40px;
   }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-nav" style="background-color: #343a40;">
    <div class="container con_full">
        <a href="{{url('/')}}" class="navbar-brand">
            <img src="https://lpkn.id/front_assets/lpkn_iso_putih.png" alt="LPKN Logo" class="brand-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        $routes = \Route::currentRouteName();
        // dd($routes);
        ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
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
            </ul>
            @if(\Auth::check())
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" style="padding-top: 0.1rem;" data-toggle="dropdown" href="#">
                        <div class="parent_pa img-avatar" style="padding: 0px;">
                            <img class="pa" src="{{\Helper::showImage(\Auth::user()->member->foto_profile, 'poto_profile')}}" alt="User profile picture">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
                        <span class="dropdown-header" style="padding: 0rem 1.5rem;">
                            <h5>{{\Auth::user()->name}}</h5>
                        </span>
                        <div class="dropdown-divider"></div>
                        <a href="{{route('member_profile.edit_profile')}}" class="dropdown-item">
                            <i class="fa fa-user mr-2"></i> Profile
                        </a>
                        <a href="{{route('member_profile.edit_profile')}}" class="dropdown-item">
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
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
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
