<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
	<div class="col-md-12 col-lg-12 col-sm-12">
		<div class="white-box">
			<div class="d-md-flex mb-3">
				<h3 class="box-title mb-0">Pesanan Jasa Servis <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form">Tambah Keluhan</button></h3>
			</div>
			<div class="table-responsive">
				<table class="table no-wrap">
					<thead>
						<tr>
							<th class="border-top-0">#</th>
							<th class="border-top-0">Keluhan</th>
							<th class="border-top-0">Harga</th>
							<th class="border-top-0">gambar</th>
							<th class="border-top-0">Status</th>
						</tr>
					</thead>
					<tbody id="target">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
				<h3 class="modal-title">Form Pemesanan</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Keluhan</label>
						<select class="form-select" name="keluhan" id="keluhan" onchange="harga_keluhan()" aria-label="Default select example">

						</select>
					</div>
					<div class="mb-3">
						<div class="form-floating">
							<textarea class="form-control" id="detail_keluhan" name="detail_keluhan" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
							<label for="floatingTextarea">Detail Keluhan</label>
						</div>
					</div>
					<div class="mb-3">
						<div class="mb-3">
							<label for="formFileSm" class="form-label">Masukan Gambar</label>
							<input class="form-control form-control-sm" name="gambar" id="gambar" onchange="loadFile(event)" type="file">
						</div>
					</div>
					<div class="mb-3">
						<div class="col-md-9" id="preview">
							<div class="tampil-gambar" accept="image/*"><img id="output" src="" style="height: 100px; "></div>
						</div>
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Harga</label>
						<input class="form-control" type="text" name="harga" id="harga" value="Disabled readonly input" aria-label="Disabled input example" disabled readonly>
						</select>
					</div>
					<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="tambahData()" class="btn btn-primary">Save</button>
				<button type="button" id="btnEdit" onclick="editData()" class="btn btn-warning">Edit</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>



<script>
	ambilData();
	selectKeluhan();

	var loadFile = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}

	function tambahData() {

		//stop submit the form, we will post it manually.
		// event.preventDefault();

		// Get form
		var form = $('#forms')[0];


		var data = new FormData();

		// If you want to add an extra field for the FormData
		data.append('gambar', $('#gambar').prop('files')[0]);
		// data.append('nama_customer', $("[name='nama_customer']").val());
		// data.append('alamat', $("[name='alamat']").val());
		data.append('keluhan', $("[name='keluhan']").val());
		data.append('detail_keluhan', $("[name='detail_keluhan']").val());
		data.append('harga', $("[name='harga']").val());

		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'customer/dashboard/tambahData' ?>',
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(hasil) {
				$(".form-group").removeClass('has-error');
				// $( ".form-group" ).after('')

				var json = $.parseJSON(hasil)
				// console.log(json.data);
				if (json.error == 0) {
					Swal.fire(
						'Good job!',
						'You clicked the button!',
						'success'
					);
					$('#form').modal('hide');
					ambilData();
					// $("[name='nama_customer']").val('')
					// $("[name='alamat']").val('')
					$("[name='keluhan']").val('')
					$("[name='detail_keluhan']").val('')
					$("[name='harga']").val('')
					$("[name='gambar']").val('')



				} else {
					for (let index = 0; index < Object.keys(json.data).length; index++) {
						$('[name="' + Object.keys(json.data)[index] + '"]').closest(".form-group").addClass('has-error')
						// $('[name="'+Object.keys(json.data)[index]+'"]').after("<span class='help-block'>"+Object.values(json.data)[index]+"</span>")
					}
					Swal.fire(
						'Gagal!',
						json.data,
						'error'
					);
					// console.log(Object.keys(json.data)[0]);
					// alert(json.data);
					// ambilData();
				}
			}
		});
	}

	function selectKeluhan(id) {
		var x = $('#keluhan');
		if (id !== undefined) {
			var option = '<option value="">--Select Data--</option>';
		} else {
			var option = '<option value="" selected>--Select Data--</option>';
		}
		$.ajax({
			url: '<?= base_url() ?>customer/dashboard/selectKeluhan',
			success: function(result) {
				result = $.parseJSON(result)
				console.log(result[0].id_keluhan);
				for (let i = 0; i < result.length; i++) {
					if (result[i].id_keluhan == id) {
						option += '<option selected value="' + result[i].id_keluhan + '" data-id="' + result[i].id_keluhan + '" >' + result[i].nama_keluhan + '</option>'
					} else {
						option += '<option value="' + result[i].id_keluhan + '" data-id="' + result[i].id_keluhan + '" >' + result[i].nama_keluhan + '</option>'
					}
				}
				x.html(option);
			}
		});
	}

	function harga_keluhan() {
		var x = document.getElementById('keluhan').value;
		$.ajax({
			url: '<?= base_url() ?>customer/dashboard/cekHarga/' + x,
			success: function(result) {
				document.getElementById('harga').value = result;
			}
		});
	}

	function ambilData() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . "customer/dashboard/ambilData" ?>',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				if (data.length < 1) {
					baris += '<tr>' +
						'<td colspan="5" class="text-center"> Data Tidak Ditemukan</td>' +
						'<tr>';
					$('#target').html(baris);
				} else {
					var baris = '';
					for (var i = 0; i < data.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td class="txt-oflo">' + data[i].keluhan + '</td>' +
							'<td class="txt-oflo">' + data[i].harga + '</td>' +
							'<td class="txt-oflo"><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + data[i].gambar + '></td>' +
							'<td class="txt-oflo">' + data[i].status + '</td>' +
							'<tr>';
					}
					$('#target').html(baris);
				}
			}
		});
	}
</script>
