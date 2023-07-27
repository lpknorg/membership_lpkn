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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a href="http://localhost/member.lpkn.id/" class="navbar-brand">
    <img src="https://lpkn.id/front_assets/lpkn_iso_putih.png" alt="LPKN Logo" class="brand-image">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a href="http://localhost/member.lpkn.id/" class="nav-link">Beranda</a>
      </li>
      <li class="nav-item">
        <a href="{{route('member_profile.allevent', ['id' => 0])}}" class="nav-link">Event</a>
      </li>
      <li class="nav-item">
        <a href="http://localhost/member.lpkn.id/page/allnews" class="nav-link">Berita</a>
      </li>
      <li class="nav-item">
        <a href="http://localhost/member.lpkn.id/page/allvideo" class="nav-link">Video</a>
      </li>
      <div class="dropdown show">
        <a class="nav-link  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown 
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a href="http://localhost/member.lpkn.id/page/peraturan" class="dropdown-item download-peraturan">Peraturan</a>
          <a href="http://localhost/member.lpkn.id/page/video" target="blank_" class="dropdown-item download-video">Video</a>
        </div>
      </div>
    </ul>
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
     <!-- Messages Dropdown Menu -->
     <li class="nav-item dropdown">
      <a class="nav-link" style="padding-top: 0.1rem;" data-toggle="dropdown" href="#">
       <div class="parent_pa img-avatar" style="padding: 0px;">
        <!-- <img class="pa" src="http://localhost:8080/member_vendor_v4/assets/img/avatars/profile-img.jpg" alt="admin@bootstrapmaster.com"> -->
        <img class="pa" src="http://localhost/member.lpkn.id/uploads/foto_profile/20230331-6426baee7b4d8.jpg" alt="User profile picture">
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
     <span class="dropdown-header text-white">
      <h5>Sendi Coba</h5>
    </span>
    <div class="dropdown-divider"></div>
    <a href="http://localhost/member.lpkn.id/page/profile" class="dropdown-item">
     <i class="fas fa-user mr-2"></i> Profile
   </a>
   <a href="#" data-toggle="modal" data-target="#ubah_password" class="dropdown-item">
    <i class="fas fa-key mr-2"></i> Ubah Password
    <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
  </a>
  <div class="dropdown-divider"></div>
  <a href="http://localhost/member.lpkn.id/auth/logout" class="dropdown-item">
    <i class="fas fa-lock mr-2"></i> Log Out
    <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
  </a>
</div>
</li>
</ul>
</div>
</nav>