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