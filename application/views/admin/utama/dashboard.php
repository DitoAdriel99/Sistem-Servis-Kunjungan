<div class="row">
	<ol class="breadcrumb">
		<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
		<li class="active">Halaman Utama</li>
	</ol>
</div>
<h1>Halaman Utama</h1>

<div class="panel panel-container">
	<div class="row">
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-teal panel-widget border-right">
				<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
					<div id="orderan" class="large"></div>
					<div class="text-muted">Pesanan Masuk</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-red panel-widget ">
				<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
					<div id="og" class="large"></div>
					<div class="text-muted">Pesanan Proses</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-blue panel-widget border-right">
				<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
					<div id="lps" class="large"></div>
					<div class="text-muted">Pesanan Selesai</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
			<div class="panel panel-orange panel-widget border-right">
				<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
					<div id="lt" class="large"></div>
					<div class="text-muted">Teknisi</div>
				</div>
			</div>
		</div>

	</div>
	<!--/.row-->
</div>
<div class="col-md-6">
	<div class="panel panel-default ">
		<div class="panel-heading">
			List Pesanan
			<ul class="pull-right panel-settings panel-button-tab-right">
				<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
						<em class="fa fa-cogs"></em>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<ul class="dropdown-settings">
								<li><a href="#">
										<em class="fa fa-cog"></em> Settings 1
									</a></li>
								<li class="divider"></li>
								<li><a href="#">
										<em class="fa fa-cog"></em> Settings 2
									</a></li>
								<li class="divider"></li>
								<li><a href="#">
										<em class="fa fa-cog"></em> Settings 3
									</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>
		<div class="panel-body timeline-container" style="display: block;">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Customer</th>
						<th scope="col">Keluhan</th>
						<th scope="col">Handle</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="target">

				</tbody>
			</table>

		</div>
	</div>
</div>


<div class="col-md-6">
	<div class="panel panel-default ">
		<div class="panel-heading">
			List Teknisi
			<a href="#formteknisi" data-toggle="modal" class="btn btn-md btn-primary">Tambah data</a>
			<ul class="pull-right panel-settings panel-button-tab-right">
				<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
						<em class="fa fa-cogs"></em>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<ul class="dropdown-settings">
								<li><a href="#">
										<em class="fa fa-cog"></em> Settings 1
									</a></li>
								<li class="divider"></li>
								<li><a href="#">
										<em class="fa fa-cog"></em> Settings 2
									</a></li>
								<li class="divider"></li>
								<li><a href="#">
										<em class="fa fa-cog"></em> Settings 3
									</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>
		<div class="panel-body timeline-container" style="display: block;">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Teknisi</th>
						<th scope="col">Bidang</th>
						<th scope="col">Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="target-teknisi">

				</tbody>
			</table>

		</div>
	</div>
</div>


<!-- Bootstrap modal -->
<div class="modal fade" id="form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Form Pemesanan</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" value="" name="id_pesanan" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Nama Customer</label>
							<div class="col-md-9">
								<input class="form-control" placeholder="Nama Customer" name="nama_customer" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Alamat</label>
							<div class="col-md-9">

								<textarea class="form-control" placeholder="Alamat Customer" name="alamat"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Pilih Keluhan</label>
							<div class="col-md-9">
								<select class="form-control" name="keluhan" id="keluhan" onchange="harga_keluhan()">

								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Detail Keluhan</label>
							<div class="col-md-9">
								<textarea class="form-control" placeholder="Kerusakan seperti apa" rows="3" name="detail_keluhan"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Masukan Gambar</label>
							<div class="col-md-9">
								<input type="hidden" name="gambar_lama" id="gambar_lama">
								<input type="file" name="gambar" id="gambar" onchange="loadFile(event)">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Gambar Barang</label>
							<div class="col-md-9" id="preview">
								<div class="tampil-gambar" accept="image/*"><img id="output" src="" style="height: 100px; "></div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Harga Servis</label>
							<div class="col-md-9">

								<input class="form-control" placeholder="Placeholder" name="harga" id="harga" value="0" readonly>
							</div>
						</div>
					</div>
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
						<div class="form-group">
							<label class="control-label col-md-3">Nama Customer</label>
							<div class="col-md-9">
								<label class="control-label" name="nama_customer_detail"></label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Alamat</label>
							<div class="col-md-9">

								<label class="control-label" name="alamat_detail"></label>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Pilih Keluhan</label>
							<div class="col-md-9">
								<label class="control-label" name="keluhan_detail"></label>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Detail Keluhan</label>
							<div class="col-md-9">
								<label class="control-label" name="detail_keluhan_detail"></label>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Gambar Barang</label>
							<div class="col-md-9" id="preview">
								<div class="tampil-gambar" accept="image/*"><img id="output_detail" src="" style="height: 100px; "></div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Harga Servis</label>
							<div class="col-md-9">

								<label class="control-label" name="harga_detail"></label>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Status</label>
							<div class="col-md-9">

								<label class="control-label" name="status_detail"></label>

							</div>
						</div>
					</div>
					<div class="modal-footer">

						<button type="button" href="#form_teknisi" data-toggle="modal" id="btn_terima" class="btn btn-primary">TERIMA</button>
						<button type="button" id="btn_tolak" value="0" onclick="tolak(this.value)" class="btn btn-warning">TOLAK</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="form_teknisi" role="dialog">
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
						<div class="form-group">
							<label class="control-label col-md-3">Pilih Teknisi</label>
							<div class="col-md-6">
								<select class="form-control" name="teknisi" id="teknisi">


								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">

						<button type="button" id="btn_terima" value="1" onclick="verifikasi(this.value)" class="btn btn-primary">PILIH</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="formteknisi" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Tambah Teknisi</h3>
				<div class="alert alert-danger print-error-msg" style="display:none">
				</div>
				<div class="modal-body form">
					<form action="#" id="formsteknisi" class="form-horizontal" method="POST" enctype="multipart/form-data">
						<input type="hidden" value="" name="id_pesanan" />
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3">Nama Teknisi</label>
								<div class="col-md-9">
									<input class="form-control" placeholder="Nama Teknisi" name="username" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">No Handphone</label>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="No Handphone" name="no_hp" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Grup</label>
								<div class="col-md-9">
									<select name="grup" class="form-control">
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="Masukan Password" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Masukan Gambar</label>
								<div class="col-md-9">
									<input type="file" name="foto" id="foto" onchange="loadFile1(event)">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Foto Teknisi</label>
								<div class="col-md-9" id="preview1">
									<div class="tampil-gambar" accept="image/*"><img id="output1" src="" style="height: 100px; "></div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnSave" onclick="tambahTeknisi()" class="btn btn-primary">Save</button>
					<button type="button" id="btnEdit" onclick="editData()" class="btn btn-warning">Edit</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div>

<div class="modal fade" id="cek_pesanan" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Sejarah pesanan</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_pesanan" id="id_pesanan" />
					<div class="form-body">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Tanggal pesan</th>
									<th scope="col">Keluhan</th>
									<th scope="col">Teknisi</th>
								</tr>
							</thead>
							<tbody id="target-cek">

							</tbody>
						</table>
					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script>
	ambilData();
	ambilTeknisi()
	listOrderan();
	listPesananSelesai();
	onGoing();
	selectKeluhan();
	selectTeknisi();
	// location.reload();
	function cek(x) {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'admin/dashboard/cek' ?>',
			data: 'id_pesanan=' + x,
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil.length);
				if (hasil.length < 1) {
					baris += '<tr>' +
						'<td colspan="4" class="text-center"> Data Tidak Ditemukan</td>' +
						'<tr>';
					$('#target-cek').html(baris);
				} else {
					var baris = '';
					for (var i = 0; i < hasil.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td>' + hasil[i].tanggal_pesanan + '</td>' +
							'<td>' + hasil[i].nama_keluhan + '</td>' +
							'<td>' + hasil[i].username + '</td>' +
							'<tr>';
					}
					$('#target-cek').html(baris);
				}

			}

		});
	}

	var loadFile = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}

	var loadFile1 = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output1');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}

	function tambahTeknisi() {
		//stop submit the form, we will post it manually.
		// event.preventDefault();

		// Get form
		var form = $('#formsteknisi')[0];


		var data = new FormData();

		// If you want to add an extra field for the FormData
		data.append('foto', $('#foto').prop('files')[0]);
		data.append('username', $("[name='username']").val());
		data.append('no_hp', $("[name='no_hp']").val());
		data.append('grup', $("[name='grup']").val());
		data.append('password', $("[name='password']").val());

		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'admin/dashboard/tambahTeknisi' ?>',
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(hasil) {
				var json = $.parseJSON(hasil)
				console.log(json);
				if (json.error == 0) {
					alert('data berhasil dimasukan')
					$('#formteknisi').modal('hide');
					ambilData();
					ambilTeknisi()
					listOrderan();
					listPesananSelesai();
					onGoing();
				} else {
					alert('data gagal dimasukan ')
					ambilData();
					ambilTeknisi()
					listOrderan();
					listPesananSelesai();
					onGoing();
				}


			}
		});
	}

	function selectTeknisi(x) {

		// console.log(x);
		var option = '<option value="" selected>--Select Data--</option>';
		$.ajax({
			url: '<?= base_url() ?>admin/dashboard/selectTeknisi/' + x,
			type: 'json',
			success: function(result) {
				// console.log(hasil)
				result = $.parseJSON(result)

				for (let i = 0; i < result.length; i++) {
					option += '<option value="' + result[i].id_user + '" data-id="' + result[i].id_user + '" >' + result[i].username + '</option>'
				}
				$('#teknisi').html(option)
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
			url: '<?= base_url() ?>admin/dashboard/selectKeluhan',
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

	function ambilData() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . "admin/dashboard/ambilData" ?>',
			dataType: 'json',
			success: function(data) {
				console.log(data.length);
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
							'<td>' + data[i].nama_customer + '</td>' +
							'<td>' + data[i].nama_keluhan + '</td>' +
							'<td><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + data[i].gambar + '></td>' +
							'<td><a href="#detail_pesanan" data-toggle="modal" onclick="detail_pesanan(' + data[i].id_pesanan + ')" class="btn btn-md btn-success"><i class="fa fa-list"></i><a href="#cek_pesanan" data-toggle="modal" onclick="cek(' + data[i].id_pesanan + ')" class="btn btn-md btn-primary"><i class="fa fa-book"></i></td>' +
							'<tr>';
					}
					$('#target').html(baris);
				}
			}
		});
	}



	function ambilTeknisi() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . "admin/dashboard/ambilTeknisi" ?>',
			dataType: 'json',
			success: function(data) {
				// alert(data.length)
				$('#lt').html(data.length);
				if (data.length < 1) {
					var baris = '';
					baris += '<tr>' +
						'<td colspan="5" class="text-center"> Data Tidak Ditemukan</td>' +

						'<tr>';

					$('#target-teknisi').html(baris);
				} else {

					var baris = '';
					for (var i = 0; i < data.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td>' + data[i].username + '</td>' +
							'<td>' + data[i].grup + '</td>' +
							'<td>' + data[i].status + '</td>' +
							'<td><a onclick="hapusDataTeknisi(' + data[i].id_user + ')" class="btn btn-md btn-danger"><i class="fa fa-trash"></i></td>' +

							'<tr>';
					}
					$('#target-teknisi').html(baris);
				}


			}
		})
	}



	function detail_pesanan(x) {
		$.ajax({
			type: 'post',
			url: '<?= base_url() . 'admin/dashboard/ambilId' ?>',
			data: 'id_pesanan=' + x,
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil['id_pesanan'])
				if (hasil['status'] == null) {
					var ss = 'Menunggu'
				} else {
					var ss = hasil['status']
				}
				// console.log(hasil);
				$('#id_pesanan').val(hasil['id_pesanan']);
				$('[name="id_pesanan"]').text(hasil['id_pesanan']);
				$('[name="nama_customer_detail"]').text(hasil['nama_customer']);
				$('[name="alamat_detail"]').text(hasil['alamat']);
				$('[name="keluhan_detail"]').text(hasil['keluhan']);
				$('[name="detail_keluhan_detail"]').text(hasil['detail_keluhan']);
				$('[name="harga_detail"]').text(hasil['harga']);
				$('[name="status_detail"]').text(ss);
				$('#output_detail').attr('src', '<?= base_url() ?>gambar/' + hasil['gambar']);
				selectTeknisi(hasil['id_pesanan']);
			}
		});
	}

	function tolak(x) {
		var id_pesanan = $('#id_pesanan').val()
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'admin/dashboard/tolak' ?>',
			data: {
				'id_pesanan': id_pesanan,
				'status': x,
			},
			success: function(hasil) {
				alert('Berhasil')
				$('#detail_pesanan').modal('hide');
				ambilData();
				ambilTeknisi()
				listOrderan();
				listPesananSelesai();
				onGoing();
			}
		});
	}



	function verifikasi(sts) {
		var id_pesanan = $('#id_pesanan').val()
		var teknisi = $('#teknisi').val()
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'admin/dashboard/verifikasi' ?>',
			data: {
				'id_pesanan': id_pesanan,
				'status': sts,
				'teknisi': teknisi,
			},
			dataType: 'json',
			beforeSend: function() {
				ambilData();
			},
			success: function(hasil) {
				console.log(hasil);
				if (hasil.error == 0) {
					$('#detail_pesanan').modal('hide');
					$('#form_teknisi').modal('hide');
					ambilData();
					ambilTeknisi()
					listOrderan();
					listPesananSelesai();
					onGoing();
					alert('Berhasil')
				} else {
					alert('Data gagal di input')
					$('#detail_pesanan').modal('hide');
					ambilData();
					ambilTeknisi()
					listOrderan();
					listPesananSelesai();
					onGoing();
				}
			}
		});
	}

	function listOrderan() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . "admin/dashboard/ambilData" ?>',
			dataType: 'json',
			success: function(data) {
				// console.log(data.length);
				$('#orderan').html(data.length);
				// ambilData();
			}

		});
	}

	function listPesananSelesai() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() . "admin/dashboard/pesananselesai" ?>',
			dataType: 'json',
			success: function(data) {
				// alert(data.length)
				$('#lps').html(data.length)
			}
		});
	}


	function harga_keluhan() {
		var x = document.getElementById('keluhan').value;
		$.ajax({
			url: '<?= base_url() ?>admin/dashboard/cekHarga/' + x,
			success: function(result) {
				document.getElementById('harga').value = result;
			}
		});
	}

	function onGoing() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() ?>admin/dashboard/ambilProses/',
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil);
				$('#og').html(hasil.length);
			}
		});
	}

	function tambahData() {

		//stop submit the form, we will post it manually.
		// event.preventDefault();

		// Get form
		var form = $('#forms')[0];


		var data = new FormData();

		// If you want to add an extra field for the FormData
		data.append('gambar', $('#gambar').prop('files')[0]);
		data.append('nama_customer', $("[name='nama_customer']").val());
		data.append('alamat', $("[name='alamat']").val());
		data.append('keluhan', $("[name='keluhan']").val());
		data.append('detail_keluhan', $("[name='detail_keluhan']").val());
		data.append('harga', $("[name='harga']").val());

		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'admin/dashboard/tambahData' ?>',
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
					$('#form_teknisi').modal('hide');
					ambilData();
					ambilTeknisi()
					listOrderan();
					listPesananSelesai();
					onGoing();
					$("[name='nama_customer']").val('')
					$("[name='alamat']").val('')
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

	function submit(x) {
		if (x == 'tambah') {
			$('#btnSave').show();
			$('#btnEdit').hide();
			$("[name='nama_customer']").val('')
			$("[name='alamat']").val('')
			$("[name='keluhan']").val('')
			$("[name='detail_keluhan']").val('')
			$("[name='harga']").val('')
			$("[name='gambar']").val('')
			$('#output').removeAttr('src');

		} else {
			$('#btnSave').hide();
			$('#btnEdit').show();

			$.ajax({
				type: 'post',
				url: '<?= base_url() . 'admin/dashboard/ambilId' ?>',
				data: 'id_pesanan=' + x,
				dataType: 'json',
				success: function(hasil) {
					console.log(hasil['id_keluhan']);
					selectKeluhan(hasil['id_keluhan']);

					$('[name="id_pesanan"]').val(hasil['id_pesanan']);
					$('[name="nama_customer"]').val(hasil['nama_customer']);
					$('[name="alamat"]').val(hasil['alamat']);
					// $('[name="keluhan"]').val(hasil['keluhan']);
					$('[name="detail_keluhan"]').val(hasil['detail_keluhan']);
					$('[name="gambar_lama"]').val(hasil['gambar']);
					$('#output').attr('src', '<?= base_url() ?>gambar/' + hasil['gambar']);
					$('[name="harga"]').val(hasil['harga']);
				}
			});
		}
	}

	function hapusDataTeknisi(x) {
		// alert(x);
		// die;
		let confirmAction = confirm("Apakah Anda Yakin Menghapus?");

		if (confirmAction) {
			$.ajax({
				type: 'POST',
				url: '<?= base_url() .  "admin/Dashboard/HapusDataTeknisi" ?> ',
				data: 'id_user=' + x,
				success: function() {
					ambilData();
					ambilTeknisi()
					listOrderan();
					listPesananSelesai();
					onGoing();
					alert('mantap')
				}
			});
		} else {
			alert('Gagal');
		}

	}

	function hapusData(id_pesanan) {

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= base_url() . "admin/dashboard/hapusData/" ?>',
					data: 'id_pesanan=' + id_pesanan,
					success: function() {
						// console.log('berhasil');
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
						)
						ambilData();
						ambilTeknisi()
						listOrderan();
						listPesananSelesai();
						onGoing();
					}
				});
			}
		})
	};
</script>
