@extends('layouts.template')
@section('breadcumb')
<style>
    .gradient-custom {
        background: #f6d365;
        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
    }
    .fab{
        padding: 3px;
    }
</style>
<div class="col-md-12 page-title">
	<div class="title_left">
		<h3>Halaman Profile</h3>
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12">
        <div class="dashboard_graph x_panel">
            <section class="" style="background-color: #f4f5f7;">
                <div class="container py-3 px-3 h-3">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col col-lg-12 mb-4 mb-lg-0">
                            <div class="card mb-3" style="border-radius: .5rem;">
                            
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white"
                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                        alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                    <h5>{{$users->name}}</h5>
                                    <p>{{$users->email}}</p>
                                    <i class="fa fa-phone mb-5"></i>
                                    </div>
                                    <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h6>Information</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{$users->email}}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted">123 456 789</p>
                                        </div>
                                        </div>
                                        <h6>Projects</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Recent</h6>
                                            <p class="text-muted">Lorem ipsum</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Most Viewed</h6>
                                            <p class="text-muted">Dolor sit amet</p>
                                        </div>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                        <a href="#!"><i class=" fab fa fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class=" fab fa fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class=" fab fa fa-instagram fa-lg"></i></a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('admin.kategori_tempat_kerja.modal')
@endsection
@section('scripts')