toastr.options = {
  "closeButton": true,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

function sendAjax(elem, is_complete=true, txt_button){
    if (is_complete) {
        $(`${elem}`).html(`${txt_button}`).prop('disabled', false)
    }else{
        $(`${elem}`).html('Load...').prop('disabled', true)
    }
}

function showAlert(msg, type='success'){
    if (type == 'error') {
        toastr.error(msg)
    }else{
        toastr.info(msg)
    }
}

$('#form_update_profile').submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name=_token]').val()
        }
    });

    var form_data = new FormData($(this)[0]);
    form_data.append('foto_profile', $('[name=foto_profile]').prop('files')[0]);

    $.ajax({
        type: 'post',
        url: $(this).attr("action"),
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        beforeSend: function() {
            sendAjax('#btnUpdatePP', false)
        },
        success: function(data) {
            console.log(data)
            if (data.status == "ok") {
                showAlert(data.messages)
                setTimeout(function() {
                    location.reload()
                }, 1000);
            }
        },
        error: function(data) {
            var data = data.responseJSON;

            if (data.status == "fail") {
                showAlert(data.messages, "error")
            }
        },
        complete: function() {
            sendAjax('#btnUpdatePP', true, 'Simpan Foto Profile')
        }
    });
});
function imagesPreview(input, placeToInsertImagePreview){
    $(placeToInsertImagePreview).html('');
    if (input.files) {
        var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function(event) {
            console.log(placeToInsertImagePreview)
                $($.parseHTML(`<img class="imgPrv form-control" style="width: 100%;display: inline; height: 200px;">`)).attr('src', event.target.result).appendTo(placeToInsertImagePreview);

            }

            reader.readAsDataURL(input.files[i]);
        }
    }
}