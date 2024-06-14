<!DOCTYPE html>
<html>
<head>
    <title>Form Biodata Pelatihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
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
        }
        button[type=submit]:hover{
            color: #fff;
            border: none;
            border-radius: 10px 20px 10px 20px;
            background-color: rgb(125 13 177);
        }
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
                            <button type="submit" class="btn btn-primary w-25 d-none">Kirim</button>
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
    <script>
        $(document).ready(function(){
            $('#btnCekData').click(function(e){
                e.preventDefault()
                $.ajax({
                    url: '{{url('form_peserta', $id_events)}}',
                    type: 'get',
                    data: {
                        email: $('[name=email]').val()
                    },
                    beforeSend: function(){
                        $('#btnCekData').attr('disabled', true).css('cursor', 'not-allowed').text('Load ...')
                    },
                    success: function(response) {    
                        $('#btnCekData').attr('disabled', false).css('cursor', 'pointer').text('Cek Data')
                        $('#divContent').html(response)
                        setTimeout(() => {
                            $('button[type=submit]').removeClass('d-none')
                        }, 1500)
                    },
                    error: function(err) {
                        $('#btnCekData').attr('disabled', false).css('cursor', 'pointer').text('Cek Data')          
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
                            toastr.success(response.messages, 'Berhasil');
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
