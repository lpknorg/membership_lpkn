<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata Pelatihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/select2/css/select2.css') }}">
    <!-- <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'> -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        body{
            background-color: rgb(227, 217, 232);
        }
        .form-group{
            margin-bottom: 0;
        }
        .card{
            border-radius: 12px;            
        }
        .card #top{
            border-top: 15px solid rgb(70, 2, 101);
        }
        .card-body{            
            border-radius: 12px;            
        }
        .form-group label{
            font-weight: 600;
        }
        span.text-info{
            font-size: 15px;
            font-weight: 600;
        }
        span.text-danger{
            font-size: 17px;
            font-weight: 600;
        }
        button[type=submit]{
            color: #fff;
            border: none;
            background-color: rgb(70, 2, 101);
            transition: 0.6s;
            font-weight: bold;
        }
        button[type=submit]:hover{
            color: #fff;
            border: none;
            border-radius: 10px 20px 10px 20px;
            background-color: rgb(125 13 177);
        }
        #btnCekData{
            color: rgb(70, 2, 101);
            border: none;
            border: 1px solid rgb(70, 2, 101);
            transition: 0.6s;
            font-weight: bold;
        }
        #btnCekData:hover{
            color: #fff;
            border: none;
            border-radius: 10px 20px 10px 20px;
            background-color: rgb(125 13 177);
        }
        h2{
            font-family: 'Lexend';font-optical-sizing: auto;font-size: 29px;
        }
        h6{
            font-family: 'Lexend';font-optical-sizing: auto;font-size: 16px;
        }
        .select2-container .select2-selection--single{height:calc(2.25rem + 2px)!important}
        #span-instansi{
            font-weight: 400;
            line-height: 1.2;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <div class="modal fade" id="modalMateri" tabindex="-1" role="dialog" aria-labelledby="modalMateriLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMateriLabel">Link Materi & Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
            @endif
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body" id="top">


                        <h2>Biodata Peserta Pelatihan dan Ujian {{$list_event['event']['judul']}}</h2>
                        <h6>Bapak/Ibu dimohon untuk mengisi dengan hati - hati agar tidak terjadi Kesalahan Data 🙏🏻</h6>
                        <h6>Pelaksanaan :
                            @if($list_event['event']['tgl_start'] == $list_event['event']['tgl_end'])
                            {{\Helper::changeFormatDate($list_event['event']['tgl_start'], 'd-M-Y')}}
                            @endif
                            {{\Helper::changeFormatDate($list_event['event']['tgl_start'], 'd-M-Y').' s/d '. \Helper::changeFormatDate($list_event['event']['tgl_end'], 'd-M-Y')}}  
                        </h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('form_peserta_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_event" value="{{ $list_event['event']['id'] }}">
                            <div class="form-group">
                                <label class="form-label" for="email">Email Aktif:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="email" class="form-control" name="email">
                            </div>
                            <a class="btn btn-outline-primary btn-sm w-25 mt-2" id="btnCekData" href="javascript:void(0)">Cek Data</a>
                            <div id="divContent">

                            </div>                            
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{ asset('template/select2/js/select2.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function(){
            // reload broser tiap 30 menit jika tidak ada aktivitas pada browser
            var timer;
            var interval = 20 * 60 * 1000; // 30 menit dalam milidetik

            function resetTimer() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    alert(123)
                    location.reload();
                }, interval);
            }

            $(document).on('mousemove keydown click scroll', function() {
                resetTimer();
            });
            resetTimer();

            function validateEmail(email) {
                const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                return re.test(String(email).toLowerCase());
            }

            function convertImage(that, go_to){
                var file = that.files[0];
                var validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (file) {
                    if ($.inArray(file.type, validImageTypes) < 0) {
                        toastr.error('Format tidak valid', 'Error');
                        $(go_to).hide();
                        return
                    }
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $(go_to).attr('src', event.target.result).show();
                    }
                    reader.readAsDataURL(file);
                }
            }
            $('body').on('click', '[id="btnVideoMateri"]', function(e) {
                e.preventDefault()
                let _sl = $(this).attr('data-slug')
                $.ajax({
                    url: "{{url('member_profile/page/get_video_materi')}}" + '/' + _sl,
                    method: 'GET',
                    success: function(d){
                        var matt = JSON.parse(d)
                        if (matt[0] == '') {
                            toastr.error('Video & materi belum ada', 'Error');
                        }else{
                            var cont = '<span class="ml-3">Berikut adalah akses link youtube dan materi : <span>'
                            cont += '<ul>'
                            $.each(matt, function(k, v){
                                _link = v.match(/\b(http|https)?(:\/\/)?(\S*)\.(\w{2,4})(.*)/g)
                                if (_link) {
                                    _link = _link
                                }else{
                                    _link = ''
                                }
                                _removal = v.replace(_link, '')
                                console.log(_removal)
                                console.log(_link)
                                if (v != '' && _link != '') {
                                    let linkBesar = _removal.charAt(0).toUpperCase() + _removal.slice(1)
                                    cont += `<li>${linkBesar}<a href="${_link}" target="_blank">menuju link</a></li>`
                                }
                            })
                            cont += '</ul>'
                            $('#modalMateri').modal('show')
                            $('#modalMateri .modal-body').html(cont)
                        }
                    },
                    error: function(e){
                        toastr.error('Ada kesalahan saat ambil data sertifikat', 'Error');
                    }
                })
            })
            $('body').on('change', '[name=foto_ktp]', function(e) {
                convertImage(this, '#displayImageKtp')
            })   
            $('body').on('change', '[name=status_kepegawaian]', function(e) {
                let val = $(this).find(':selected').val()
                if (val == 'PNS') {
                    $('#divPns').show(200)
                }else{
                    $('#divPns').hide(200)
                }
                let _tni = val.substr(0, 3)
                if (val == 'POLRI' || _tni == 'TNI') {
                    $('#divPolriTni').show(200)
                }else{
                    $('#divPolriTni').hide(200)
                }
            })
            function getKota(_val){
                $.ajax({
                    type: 'get',
                    url: "{{ url('api/general/kota') }}",
                    data: {
                        id_provinsi: _val
                    },
                    success: function(data) {
                        console.log(data)
                        let opt = '<option value="">Pilih Kota</option>'
                        $.each(data.data, function(k, v) {
                            opt +=
                            `<option value="${v.id}">${v.kota}</option>`
                        })
                        $(`[name=kota]`).prop('disabled', false).html(opt)
                    },
                    error: function(data) {
                        toastr.error('Ada kesalahan dalam mendapatkan data kota', 'Error');
                    }
                });
            }
            $('body').on('change', '[name=provinsi]', function(e) {
                let _val = $(this).find(":selected").val()
                console.log(_val)
                getKota(_val)
            })
            $('body').on('change', '[name=pas_foto]', function(e) {
                convertImage(this, '#displayImagePasFoto')
            })            
            $('#btnCekData').click(function(e){
                let _email = $('[name=email]').val()
                if(_email == ''){
                    toastr.error('Email aktif wajib diisi', 'Error');
                    return
                }
                if (!validateEmail(_email)) {
                    toastr.error('Format email tidak valid', 'Error');
                    return
                }
                e.preventDefault()
                $.ajax({
                    url: '{{url('form_peserta_ajax', $id_events)}}',
                    type: 'get',
                    data: {
                        email: _email
                    },
                    beforeSend: function(){
                        $('#btnCekData').attr('disabled', true).css('cursor', 'not-allowed').text('Load ...')
                    },
                    success: function(response) {    
                        $('#btnCekData').attr('disabled', false).css('cursor', 'pointer').text('Cek Data')
                        $('#divContent').html(response)
                        setTimeout(() => {
                            $('[name=pendidikan_terakhir]').select2({
                                width : '100%'
                            })
                            $('[name=posisi_pengadaan]').select2({
                                width : '100%'
                            })
                            $('[name=jenis_jabatan]').select2({
                                width : '100%'
                            })
                            $('[name=provinsi]').select2({
                                width : '100%'
                            })
                            $('[name=golongan_terakhir]').select2({
                                width : '100%'
                            })
                            $('[name=kota]').select2({
                                width : '100%'
                            })
                            $('[name=konfirmasi_paket]').select2({
                                width : '100%'
                            })
                            // $('button[type=submit]').removeClass('d-none')

                            var today = new Date();
                            var dd = String(today.getDate()).padStart(2, '0');
                            var mm = String(today.getMonth() + 1).padStart(2, '0');           
                            var yyyy = today.getFullYear();
                            today = yyyy + '-' + mm + '-' + dd;
                            $('[name=tanggal_lahir]').datepicker({
                                format: 'yyyy-mm-dd',
                                todayHighlight: true,
                                autoclose: true,
                                endDate: today
                            });

                        }, 500)
                    },
                    error: function(err) {
                        $('#btnCekData').attr('disabled', false).css('cursor', 'pointer').text('Cek Data')   
                        toastr.error('Ada kesalahan saat ambil data', 'Error');  
                        $('#divContent').html('')
                        // $('button[type=submit]').addClass('d-none')     
                    },
                    complete: function(){
                        $('#btnCekData').attr('disabled', false).css('cursor', 'pointer').text('Cek Data')
                    }
                });
            })
            $('form').on('submit', function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);

                formData.append('pas_foto', $('[name=pas_foto]').prop('files')[0]);
                @if($list_event['event']['jenis_pelatihan'] == "lkpp")
                formData.append('foto_ktp', $('[name=foto_ktp]').prop('files')[0]);
                formData.append('sk_pengangkatan_asn', $('[name=sk_pengangkatan_asn]').prop('files')[0]);
                @endif                
                $.ajax({
                    url: '{{url('form_peserta_store')}}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('button[type=submit]').attr('disabled', true).text('Load ...')
                    },
                    success: function(response) { 
                        console.log(response)
                        let _sertif = response.data_sertif

                        if (response.status == 'ok') {
                            Swal.fire({
                                icon: "success",
                                title: 'Berhasil',
                                text: response.messages,
                                timer: 3500
                            });
                            let content = '<div class="alert alert-success mt-3 mb-0">Terima Kasih Bapak/Ibu atas partisipasinya sudah mengisi form kelengkapan biodata. 🙏🏻</div>'
                            // ini kalau ada sertifikatnya
                            if(_sertif.list.length > 0){
                                console.log(_sertif.list[0])
                                content += `<a href="${_sertif.list[0].download}" target="_blank" class="btn btn-success btn-sm w-25 mt-2 mr-2">Download Seritifikat</a>`
                                // if(_sertif.list[0].video != ''){
                                content += `<a href="javascript:void()" id="btnVideoMateri" class="btn btn-primary btn-sm w-25 mt-2" data-slug="${_sertif.list[0].slug}">Video & Materi</a>`
                                // }
                            }else{
                                content += '<div class="alert alert-warning mt-2">Sertifikat belum tersedia, silakan menghubungi panitia.</div>'
                            }             
                            $('#divContent').html(content)
                            $('#btnCekData, button[type=submit]').remove()
                            $('[name=email]').prop('disabled', true)
                            setTimeout(() => {
                                // alert(123)
                            },60000)
                        } else {
                            toastr.error('Ada kesalahan saat kirim data', 'Error');
                        }
                        $('button[type=submit]').attr('disabled', false).text('Kirim')
                        setTimeout(() => {
                            // location.reload()
                        }, 1000)
                    },
                    error: function(err) {
                        let err_ = JSON.parse(err.responseText)
                        if (err_.status == 'fail') {
                            toastr.error(err_.messages, 'Error');
                        }else{
                            toastr.error('Terjadi kesalahan saat kirim data.', 'Error');
                        }
                        $('button[type=submit]').attr('disabled', false).text('Kirim')                        
                    },
                    complete: function(){
                        $('button[type=submit]').attr('disabled', false).text('Kirim')
                    }
                });
            });
        })
    </script>
</body>
</html>
