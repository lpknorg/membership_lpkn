<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata Pelatihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/select2/css/select2.css') }}">
    <!-- <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'> -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container">
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


                        <h2>Biodata Peserta Pelatihan dan Ujian {{$list_event['judul']}}</h2>
                        <h6>Bapak/Ibu dimohon untuk mengisi dengan hati - hati agar tidak terjadi Kesalahan Data 🙏🏻</h6>
                        <h6>Pelaksanaan :
                            @if($list_event['tgl_start'] == $list_event['tgl_end'])
                            {{\Helper::changeFormatDate($list_event['tgl_start'], 'd-M-Y')}}
                            @endif
                            {{\Helper::changeFormatDate($list_event['tgl_start'], 'd-M-Y').' s/d '. \Helper::changeFormatDate($list_event['tgl_end'], 'd-M-Y')}}  
                        </h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('form_peserta_store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_event" value="{{ $list_event['id'] }}">
                            <div class="form-group">
                                <label class="form-label" for="email">Email Aktif:</label><span class="text-danger"> *</span>
                                <input placeholder="Jawaban Anda" autocomplete="off" type="email" class="form-control" name="email" value="wdinda375@gmail.com">
                            </div>
                            <a class="btn btn-outline-primary btn-sm w-25 mt-2" id="btnCekData" href="javascript:void(0)">Cek Data</a>
                            <div id="divContent">

                            </div>                            
                            <button type="submit" class="btn btn-primary w-100 d-none mt-2">Kirim</button>
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
    <script>
        $(document).ready(function(){    
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
            $('body').on('change', '[name=foto_ktp]', function(e) {
                convertImage(this, '#displayImageKtp')
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
                    url: '{{url('form_peserta', $id_events)}}',
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
                            $('button[type=submit]').removeClass('d-none')
                        }, 500)
                    },
                    error: function(err) {
                        $('#btnCekData').attr('disabled', false).css('cursor', 'pointer').text('Cek Data')   
                        toastr.error('Ada kesalahan saat ambil data', 'Error');  
                        $('#divContent').html('')
                        $('button[type=submit]').addClass('d-none')     
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
                @if($list_event['jenis_pelatihan'] == "lkpp")
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
                        if (response.status == 'ok') {
                            Swal.fire({
                                icon: "success",
                                title: 'Berhasil',
                                text: response.messages,
                                timer: 3500
                            });
                            $('#divContent').html('<div class="alert alert-success mt-3">Terima Kasih Bapak/Ibu atas partisipasinya sudah mengisi form kelengkapan biodata. 🙏🏻</div>')
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
                        console.log(err_)
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
