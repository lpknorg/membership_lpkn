<style>

}
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-nav">
    <div class="container">
        <a href="{{url('/')}}" class="navbar-brand">
            <img src="https://lpkn.id/front_assets/lpkn_iso_putih.png" alt="LPKN Logo" class="brand-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('member_profile.allevent', ['id' => 1])}}" class="nav-link">Event</a>
                </li>
                <li class="nav-item">
                    <a href="https://ilmu.lpkn.id/" class="nav-link">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('member_profile.allvideo')}}" class="nav-link">Video</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('member_profile.peraturan')}}" class="nav-link">Peraturan</a>
                </li>
            </ul>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" style="padding-top: 0.1rem;" data-toggle="dropdown" href="#">
                        <div class="parent_pa img-avatar" style="padding: 0px;">
                            <img class="pa" src="{{\Helper::showImage('poto_profile', \Auth::user()->member->foto_profile)}}" alt="User profile picture">
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
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-2"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
