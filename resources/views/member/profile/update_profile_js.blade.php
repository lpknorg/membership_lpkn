<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function(){
		getProvinsi('rumah_provinsi')
		getKota('{{$user->member->prov_id}}', 'rumah_kota')
		getKecamatan('{{$user->member->kota_id}}', 'rumah_kecamatan')
		getKelurahan('{{$user->member->kecamatan_id}}', 'rumah_kelurahan')

		getProvinsi('kantor_provinsi', '{{$user->member->memberKantor->kantor_prov_id}}')
		getKota('{{$user->member->memberKantor->kantor_prov_id}}', 'kantor_kota', '{{$user->member->memberKantor->kantor_kota_id}}')
		@if($user->member->memberKantor->kantor_kota_id)
		getKecamatan('{{$user->member->memberKantor->kantor_kota_id}}', 'kantor_kecamatan', '{{$user->member->memberKantor->kantor_kecamatan_id}}')
		@endif
		@if($user->member->memberKantor->kantor_kecamatan_id)
		getKelurahan('{{$user->member->memberKantor->kantor_kecamatan_id}}', 'kantor_kelurahan', '{{$user->member->memberKantor->kantor_kelurahan_id}}')
		@endif
		getLembagaPemerintahan('{{$user->member->memberKantor->instansi_id}}', 'lembaga_pemerintahan')

		function getProvinsi(selector, selected_id='{{$user->member->prov_id}}'){
			$.ajax({
				type: 'GET',
				url: '{{route('api.get.provinsi')}}',
				success: function(data) {
					let provinsi = '<option value="">-- Pilih Provinsi --</option>'
					$.each(data.data, function(k, v){
						provinsi += `<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.nama}</option>`
					})
					$(`[name=${selector}]`).attr('disabled', false).html(provinsi)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data provinsi", "error")                     
				},
				complete: function() {

				}
			});     
		}
		function getKota(_val, selector, selected_id='{{$user->member->kota_id}}'){
			$.ajax({
				type: 'GET',
				url: '{{route('api.get.kota')}}',
				data: {
					id_provinsi: _val
				},
				success: function(data) {
					let kota = '<option value="">-- Pilih Kota --</option>'
					$.each(data.data, function(k, v){
						kota += `<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.kota}</option>`
					})
					$(`[name=${selector}]`).attr('disabled', false).html(kota)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data kota", "error")                     
				},
				complete: function() {

				}
			});     
		}
		function getKecamatan(_val, selector, selected_id='{{$user->member->kecamatan_id}}'){
			$.ajax({
				type: 'get',
				url: "{{ url('api/general/kecamatan') }}",
				data: {
					id_kota: _val
				},
				success: function(data) {
					let opt = '<option value="">Pilih Kecamatan</option>'
					$.each(data.data, function(k, v) {
						opt +=
						`<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.kecamatan}</option>`
					})
					$(`[name=${selector}]`).prop('disabled', false).html(opt)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data kecamatan", "error")
				}
			});
		}
		function getKelurahan(_val, selector, selected_id='{{$user->member->kelurahan_id}}'){
			$.ajax({
				type: 'get',
				url: "{{ url('api/general/kelurahan') }}",
				data: {
					id_kecamatan: _val
				},
				success: function(data) {
					console.log(data)
					let opt = '<option value="">Pilih Kelurahan</option>'
					$.each(data.data, function(k, v) {
						opt +=
						`<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.kelurahan} - ${v.kode_pos.kode_pos}</option>`
					})
					$(`[name=${selector}]`).prop('disabled', false).html(opt)
				},
				error: function(data) {
					// showAlert("Ada kesalahan dalam mendapatkan data kelurahan", "error")
				}
			});
		}
		function getLembagaPemerintahan(_val, selector, selected_id='{{$user->member->memberKantor->lembaga_pemerintahan_id}}'){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});
			$.ajax({
				url : "{{route('api.get.lembaga_pemerintahan')}}",
				method : "post",
				data : {instansi_id:_val},
				dataType : 'json',
				success: function(data) {
					let lp = '<option value="">-- Pilih Lembaga Pemerintahan --</option>'
					$.each(data, function(k, v){
						lp += `<option value="${v.id}" ${selected_id == v.id ? 'selected' : ''}>${v.nama}</option>`
					})
					$(`[name=${selector}]`).html(lp)
				},
				error: function(data) {
					showAlert("Ada kesalahan dalam mendapatkan data lembaga pemerintahan", "error")
				}
			});
		}
		$('[name=rumah_provinsi]').change(function(){
			let _val = $(this).find(":selected").val()
			getKota(_val, 'rumah_kota')
		})
		$('[name=rumah_kota]').change(function(){
			let _val = $(this).find(":selected").val()
			getKecamatan(_val, 'rumah_kecamatan')
		})

		$('[name=rumah_kecamatan]').change(function(){
			let _val = $(this).find(":selected").val()
			getKelurahan(_val, 'rumah_kelurahan')
		})

		$('[name=kantor_provinsi]').change(function(){
			let _val = $(this).find(":selected").val()
			getKota(_val, 'kantor_kota')
		})
		$('[name=kantor_kota]').change(function(){
			let _val = $(this).find(":selected").val()
			getKecamatan(_val, 'kantor_kecamatan')
		})

		$('[name=kantor_kecamatan]').change(function(){
			let _val = $(this).find(":selected").val()
			getKelurahan(_val, 'kantor_kelurahan')
		})
		$('[name=instansi]').change(function(){
			let _val = $(this).find(":selected").val()
			getLembagaPemerintahan(_val, 'lembaga_pemerintahan')
		})
		$('body').on('change', '[name=status_kepegawaian]', function() {
			let val = $(this).find(':selected').val()
			if (val == 'BUMN/BUMD') {
				$('[id=div-dll]').hide(300)
				$('[id=div-bumn]').show(300)
			}else if (val == 'Lainnya') {
				$('[id=div-bumn]').hide(300)
				$('[id=div-dll]').show(300)
			}else{
				$('[id=div-bumn]').hide(300)
				$('[id=div-dll]').hide(300)
			}
		})
		$('#formUpdateProfile').submit(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});

			var form_data = new FormData($(this)[0]);
			// form_data.append('pas_foto', $('[name=pas_foto]').prop('files')[0]);
			form_data.append('foto_ktp', $('[name=foto_ktp]').prop('files')[0]);
			form_data.append('sk_pengangkatan_asn', $('[name=sk_pengangkatan_asn]').prop('files')[0]);

			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: form_data,
				dataType: 'json',
				processData: false,
				contentType: false,
				beforeSend: function() {
					sendAjax('#btnsubmit', false)
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
					sendAjax('#btnsubmit', true, 'Update Profile')
				}
			});
		});
		$('#btnSosialMedia').click(function(e){
			e.preventDefault()
			$('#modalSosialMedia').modal('show')
		})
		$('#formSosialMedia').submit(function(e) {
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});

			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: $(this).serialize(),
				beforeSend: function() {
					sendAjax('#btnSimpanSosmed', false)
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
					sendAjax('#btnSimpanSosmed', true, 'Simpan')
				}
			});
		});

		$('body').on('click', '[id="btnHapusSosialMedia"]', function(e){
			Swal.fire({
				title: 'Apa anda yakin ?',
				text: "Data akan hilang jika dihapus!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('[name=_token]').val()
						}
					});

					$.ajax({
						type: 'POST',
						url: $(this).attr("action"),
						data: {
							id: $(this).attr('data-id'),
							user_id : '{{$user->id}}'
						},
						dataType: 'json',
						success: function(data) {
							console.log(data)
							if (data.status == "ok") {
								showAlert(data.messages)
								setTimeout(function(){
									window.location.reload()
								}, 1000)
							}
						},
						error: function(data) {
							var data = data.responseJSON;
							if (data.status == "fail") {
								showAlert(data.messages, "error")
							}
						}
					});
				}
			})
		})

		$('body').on('click', '[id="btnHapusSertifikat"]', function(e){
			Swal.fire({
				title: 'Apa anda yakin ?',
				text: "Data akan hilang jika dihapus!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('[name=_token]').val()
						}
					});

					$.ajax({
						type: 'POST',
						url: $(this).attr("action"),
						data: {
							id: $(this).attr('data-id')
						},
						dataType: 'json',
						success: function(data) {
							if (data.status == "ok") {
								showAlert(data.messages)
								setTimeout(function(){
									window.location.reload()
								}, 1000)
							}
						},
						error: function(data) {
							var data = data.responseJSON;
							if (data.status == "fail") {
								showAlert(data.messages, "error")
							}
						}
					});
				}
			})
		})
	})
</script>