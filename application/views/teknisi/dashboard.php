<h1>Data Perbaikan</h1>
<div class="panel-body timeline-container" style="display: block;">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nama Customer</th>
				<th scope="col">Alamat</th>
				<th scope="col">Keluhan</th>
				<th scope="col">Detail</th>
				<th scope="col">Gambar</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="target">

		</tbody>
	</table>

</div>

<!-- Bootstrap modal Detail -->
<div class="modal fade" id="detail_pesanan" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Detail Pesanan</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_pesanan" id="id_pesanan" />
					<div class="form-body">
						<table class="table table-striped">
							<tbody>
								<tr>
									<td><b>Nama Customer</b></td>
									<td name="nama_customer_detail">John</td>
								</tr>
								<tr>
									<td><b>Alamat</b></td>
									<td name="alamat_detail">Peter</td>
								</tr>
								<tr>
									<td><b>Keluhan</b> </td>
									<td name="keluhan_detail">John</td>
								</tr>
								<tr>
									<td><b>Detail Keluhan</b></td>
									<td name="detail_keluhan_detail">John</td>
								</tr>
								<tr>
									<td><b>Gambar Barang</b></td>
									<td>
										<div class="col-md-9" id="preview">
											<div class="tampil-gambar" accept="image/*"><img id="output_detail" src="" style="height: 100px; "></div>
										</div>
									</td>
								</tr>
								<tr>
									<td><b>Harga</b></td>
									<td name="harga_detail">John</td>
								</tr>
								<tr>
									<td><b>Status Pekerjaan</b></td>
									<td name="status_pekerjaan_detail">John</td>
								</tr>
								<tr>
									<td><b>Jam MUlai</b></td>
									<td name="jam_mulai_detail">John</td>
								</tr>
								<tr>
									<td><b>Jam Selesai</b></td>
									<td name="jam_selesai_detail">John</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" id="btn_mulai" value="0" onclick="statuspekerjaan(this.value)" class="btn btn-primary">Mulai Kerja</button>
						<button type="button" id="btn_modal" href="#selesai" data-toggle="modal" class="btn btn-success">Upload Bukti Pekerjaan</button>
						<!-- <button type="button" id="btn_selesai" value="1" onclick="statuspekerjaan(this.value)" class="btn btn-success">Pekerjaan Selesai</button> -->
						<button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="selesai" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Bukti Pekerjaan</h3>
			</div>
			<div class="modal-body">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Barang Tambahan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="barang_tambahan" placeholder="Masukan Barang Tambahan Jika Ada">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Biaya Tambahan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="biaya_tambahan" placeholder="Masukan Biaya Tambahan Jika Ada">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Upload Gambar</label>
						<div class="col-sm-10">
							<input type="file" name="gambar_selesai" id="gambar_pekerjaan" onchange="loadFile(event)" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Gambar Barang</label>
						<div class="col-sm-10" id="preview">
							<div class="tampil-gambar" accept="image/*"><img id="output" src="" style="height: 100px; "></div>
						</div>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btnSelesai" value="1" onclick="selesai(this.value)" class="btn btn-primary">Selesai</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script>
	ambildata();

	var loadFile = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}


	function ambildata() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'teknisi/dashboard/ambilData' ?>',
			dataType: 'json',
			success: function(data) {
				console.log(data.length)
				if (data.length < 1) {
					baris += '<tr>' +
						'<td colspan="6" class="text-center"> Tidak Ada Data Perbaikan</td>' +

						'<tr>';
					$('#target').html(baris);
				} else {

					var baris = '';
					for (var i = 0; i < data.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td>' + data[i].nama_customer + '</td>' +
							'<td>' + data[i].alamat + '</td>' +
							'<td>' + data[i].nama_keluhan + '</td>' +
							'<td>' + data[i].detail_keluhan + '</td>' +
							'<td><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + data[i].gambar + '></td>' +
							'<td><a href="#detail_pesanan" data-toggle="modal" onclick="detail_pesanan(' + data[i].id_pesanan + ')" class="btn btn-md btn-success"><i class="fa fa-list"></i></td>' +
							'<tr>';
					}
					$('#target').html(baris);
				}
			}
		})
	}

	function detail_pesanan(x) {
		$.ajax({
			type: 'post',
			url: '<?= base_url() . 'teknisi/dashboard/ambilId' ?>',
			data: 'id_pesanan=' + x,
			dataType: 'json',
			success: function(data) {
				if (data['status_pekerjaan'] == null) {
					var sp = 'Menuju Lokasi'
					$('#btn_mulai').hide();
					$('#btn_modal').hide();
				} else if (data['status_pekerjaan'] == 0) {
					var sp = 'Mulai Pekerjaan';
					$('#btn_mulai').hide();
					$('#btn_selesai').hide();
				} else if (data['status_pekerjaan'] == 1) {
					var sp = 'Selesai';
					$('#btn_selesai').show();
					$('#btn_mulai').hide();

				}
				if (data['jam_mulai'] == null) {
					var jm = 'Belum Mulai Kerja'
				} else {
					var jm = data['jam_mulai']
				}
				if (data['jam_selesai'] == null) {
					var js = 'Belum Selesai'
				} else {
					var js = data['jam_selesai']
				}
				$('#id_pesanan').val(data['id_pesanan']);
				$('[name="nama_customer_detail"]').text(data['nama_customer']);
				$('[name="alamat_detail"]').text(data['alamat']);
				$('[name="keluhan_detail"]').text(data['keluhan']);
				$('[name="detail_keluhan_detail"]').text(data['detail_keluhan']);
				$('[name="harga_detail"]').text(data['biaya_tambahan']);
				$('[name="status_pekerjaan_detail"]').text(sp);
				$('[name="jam_mulai_detail"]').text(jm);
				$('[name="jam_selesai_detail"]').text(js);
				$('#output_detail').attr('src', '<?= base_url() ?>gambar/' + data['gambar']);
			}
		})
	}

	function statuspekerjaan(x) {
		var id_pesanan = $('#id_pesanan').val();
		$.ajax({
			type: 'post',
			url: '<?= base_url() . 'teknisi/dashboard/statusPekerjaan' ?>',
			data: {
				'id_pesanan': id_pesanan,
				'status_pekerjaan': x,
			},
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil['status_pekerjaan'])

				if (x == 0) {
					$('#detail_pesanan').modal('hide');
					alert('Silahkan Memulai Pekerjaan');
					location.reload()
				} else if (x == 1) {
					$('#detail_pesanan').modal('hide');
					alert('Mohon Menunggu Verifikasi');
					location.reload()
				} else {
					alert('Gagal');
					location.reload()
				}

			}
		})
	}

	function selesai() {
		//stop submit the form, we will post it manually.
		// event.preventDefault();

		// Get form
		var form = $('#forms')[0];


		var data = new FormData();

		// If you want to add an extra field for the FormData
		data.append('id_pesanan', $('#id_pesanan').val());
		data.append('gambar_pekerjaan', $('#gambar_pekerjaan').prop('files')[0]);
		data.append('barang_tambahan', $("[name='barang_tambahan']").val());
		data.append('biaya_tambahan', $("[name='biaya_tambahan']").val());


		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'teknisi/dashboard/selesai' ?>',
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(hasil) {

				var json = $.parseJSON(hasil)
				console.log(json);
				$('#detail_pesanan').modal('hide');
				$('#selesai').modal('hide');
				alert('Harap Menunggu Verifikasi Dari Customer')

			}
		});
	}
</script>
