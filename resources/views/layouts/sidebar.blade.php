<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Membership LPKN</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{asset('template/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ Auth::user()->name }}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          
          <li><a><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('dashboard2.index')}}"><i class="fa fa-calendar"></i>Event<span class="label label-success pull-right"></span></a></li>
              <li><a href="{{route('admin.user.index')}}"><i class="fa fa-user"></i>Alumni<span class="label label-success pull-right"></span></a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-gear"></i> Master <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('admin.provinsi.index')}}">Provinsi</a></li>
              <li><a href="{{route('admin.kota.index')}}">Kota</a></li>
              <li><a href="{{route('admin.instansi.index')}}">Instansi</a></li>
              <li><a href="{{route('admin.lembaga_pemerintahan.index')}}">Lembaga Pemerintahan</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-book"></i> Artikel <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('admin.artikel_kategori.index')}}">Kategori</a></li>
              <li><a href="{{route('admin.artikel.index')}}">List Artikel</a></li>
            </ul>
          </li>
          <li><a href="{{route('admin.video.index')}}"><i class="fa fa-video-camera"></i>Video<span class="label label-success pull-right"></span></a></li>
          <!-- <li><a href="{{route('admin.member.index')}}"><i class="fa fa-user"></i>Member<span class="label label-success pull-right"></span></a></li> -->
        </ul>
      </div>


    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
