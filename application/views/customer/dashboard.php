<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5>Pesanan Anda</h5>
				<span>use class <code>table-hover</code> inside table element</span>
				<div class="card-header-right">
					<button class="btn waves-effect waves-light btn-primary" id="btnTambah" data-target="#forms" data-toggle="modal">Tambah Pesanan</button>
				</div>
			</div>
			<div class="card-block table-border-style">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Keluhan</th>
								<th>Gambar</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="target">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="forms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Keluhan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Keluhan</label>
						<div class="col-sm-10">
							<select name="keluhan" id="keluhan" onchange="harga_keluhan()" class="form-control fill">
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Detail Keluhan</label>
						<div class="col-sm-10">
							<textarea rows="5" cols="5" class="form-control" name="detail_keluhan" placeholder="Default textarea"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Upload Gambar</label>
						<div class="col-sm-10">
							<input type="file" name="gambar" id="gambar" onchange="loadFile(event)" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Gambar Barang</label>
						<div class="col-sm-10" id="preview">
							<div class="tampil-gambar" accept="image/*"><img id="output" src="" style="height: 100px; "></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Disable Input</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="harga" id="harga" value="0" placeholder="Disabled text" disabled="">
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btnSave" onclick="tambahData()" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="detail_forms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Keluhan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_pesanan" id="id_pesanan" />

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Keluhan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="detail_keluhan" placeholder="Disabled text" readonly>

						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Detail Keluhan</label>
						<div class="col-sm-10">
							<textarea rows="5" cols="5" class="form-control" name="detail_keluhan_detail" placeholder="Default textarea" readonly></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Gambar Barang</label>
						<div class="col-sm-10" id="preview">
							<div class="tampil-gambar" accept="image/*"><img id="output_detail" src="" style="height: 100px; "></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Harga</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="harga_detail" id="harga" value="0" placeholder="Disabled text" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Status Pekerjaan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="status_pekerjaan_detail" id="harga" value="0" placeholder="Disabled text" readonly>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btnSelesai" value="1" onclick="verifikasi(this.value)" class="btn btn-success waves-effect waves-light">Verifikasi selesai</button>
				<button type="button" id="btnBayar" onclick="bayar()" class="btn btn-info waves-effect waves-light">Pembayaran </button>
			</div>
		</div>
	</div>
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
				var json = $.parseJSON(hasil)
				console.log(json.error);
				if (json.error == 0) {
					alert('Data Berhasil Dimasukan')
					$('#forms').modal('hide');
					ambilData();
					// $("[name='nama_customer']").val('')
					// $("[name='alamat']").val('')
					$("[name='keluhan']").val('')
					$("[name='detail_keluhan']").val('')
					$("[name='harga']").val('')
					$("[name='gambar']").val('')



				} else {

					alert('Data Gagal dimasukan')
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
					
				} else {
					$('#btnTambah').hide();
					var baris = '';
					for (var i = 0; i < data.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td class="txt-oflo">' + data[i].keluhan + '</td>' +
							'<td class="txt-oflo"><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + data[i].gambar + '></td>' +
							'<td class="txt-oflo">' + data[i].status + '</td>' +
							'<td class="txt-oflo"><button class="btn waves-effect waves-light btn-info" href="#detail_forms" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="detail_pesanan(' + data[i].id_pesanan + ')"><i class="icofont icofont-info-square">cek Detail</i></button></td>'
						'<tr>';
					}
					$('#target').html(baris);
				}
			}
		});
	}

	function detail_pesanan(x) {
		$.ajax({
			type: 'post',
			url: '<?= base_url() . "customer/dashboard/ambilId" ?>',
			dataType: 'json',
			data: 'id_pesanan=' + x,
			success: function(data) {
				console.log(data)
				if (data['status_pekerjaan'] == null) {
					var sp = 'Menuju Lokasi'
					$('#btnSelesai').hide();
					$('#btnBayar').hide();
				} else if (data['status_pekerjaan'] == 0) {
					var sp = 'Mulai Pekerjaan';
					$('#btnSelesai').hide();
					$('#btnBayar').hide();
				} else {
					var sp = 'Selesai';
					$('#btnSelesai').show();
					$('#btnBayar').hide();
				}


				$('#id_pesanan').val(data['id_pesanan']);
				$('[name="detail_keluhan"]').val(data['keluhan']);
				$('[name="detail_keluhan_detail"]').val(data['detail_keluhan']);
				$('[name="harga_detail"]').val(data['harga']);
				$('[name="status_pekerjaan_detail"]').val(sp);
				$('[name="jam_mulai_detail"]').val(data['jam_mulai']);

				$('#output_detail').attr('src', '<?= base_url() ?>gambar/' + data['gambar']);
			}
		});
	}

	function verifikasi(x){
		$.ajax({
			type: 'post',
			url : '<?= base_url() . "customer/dashboard/verifikasi"?>'
		});
	}
</script>
