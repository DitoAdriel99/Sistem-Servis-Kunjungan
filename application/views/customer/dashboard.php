<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h1>Halaman Utama</h1>
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
						<label class="col-sm-2 col-form-label">Barang</label>
						<div class="col-sm-10">
							<select name="keluhan" id="keluhan" onchange="harga_keluhan()" class="form-control fill">
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Keluhan</label>
						<div class="col-sm-10">
							<textarea rows="5" cols="5" class="form-control" name="detail_keluhan" placeholder="Default textarea"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<textarea rows="5" cols="5" class="form-control" name="alamat" placeholder="Default textarea"></textarea>
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
			<div class="modal-body form">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_pesanan" id="id_pesanan" />
					<input type="hidden" name="teknisi" id="teknisi" />

					<div class="form-body">
						<table class="table table-striped">
							<tbody>
								<tr>
									<td><b>Keluhan</b> </td>
									<td name="detail_keluhan">John</td>
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
									<td name="hasil">John</td>
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
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="btnKedatangan" value="0" onclick="kedatangan(this.value)" class="btn btn-success waves-effect waves-light">Verifikasi Kedatangan</button>
						<button type="button" id="btnSelesai" value="1" onclick="selesai(this.value)" class="btn btn-success waves-effect waves-light">Verifikasi Selesai</button>
						<button type="button" id="btnBayar" href="#pembayaran_forms" data-toggle="modal" class="btn btn-info waves-effect waves-light">Pembayaran </button>
					</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="pembayaran_forms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="#" id="forms_upload" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">
							Harap Melakukan Pembayaran Ke Rekening XXXXXXXX a/n PT.QHM
						</label>
					</div>
					<table class="table table-striped">
						<tbody id="target-hasil">
							<tr>
								<td><b>Harga Servis</b></td>
								<td name="hasil">John</td>
							</tr>
							<tr>
								<td><b>Biaya Tambahan</b></td>
								<td></td>
							</tr>
							<tr>
								<td><b name="barang_tambahan1"></b></td>
								<td name="harga_tambahan1">John</td>
							</tr>
							<tr>
								<td><b name="barang_tambahan2"></b></td>
								<td name="harga_tambahan2">John</td>
							</tr>
							<tr>
								<td><b name="barang_tambahan3"></b></td>
								<td name="harga_tambahan3">John</td>
							</tr>
							<tr>
								<td style="background-color: #D6EEEE;"><b>Total</b></td>
								<td name="total" style="background-color: #D6EEEE;">John</td>
							</tr>
						</tbody>
					</table>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Upload Gambar</label>
						<div class="col-sm-10">
							<input type="file" name="bukti_pembayaran" id="bukti_pembayaran" onchange="loadFile3(event)" class="form-control">
						</div>
					</div>
					<!-- <div class="form-group row">
						<label class="col-sm-2 col-form-label">Gambar Barang</label>
						<div class="col-sm-10" id="preview1">
							<div class="tampil-gambar" accept="image/*"><img id="output1" src="" style="height: 100px; "></div>
						</div>
					</div> -->

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="bayar" onclick="bayar()" class="btn btn-info waves-effect waves-light">Upload</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="cek_teknisi" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Teknisi yang Bertugas</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="forms" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_pesanan" id="id_pesanan" />
					<div class="form-body">

						<div class="card">
							<div class="tampil-gambar" accept="image/*"><img id="profile" src="" style="height: 100px; "></div>

							<div class="container">
								<p>Nama : <span id="username"></span> </p>
								<p>No Hp: <span id="no"></span> </p>
							</div>
						</div>
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
	selectKeluhan();

	function cekTeknisi(x) {
		$.ajax({
			type: 'post',
			url: '<?= base_url() . 'customer/dashboard/profileTeknisi' ?>',
			data: 'id_pesanan=' + x,
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil)
				$('#username').text(hasil['username']);
				$('#no').text(hasil['no_hp']);
				$('#profile').attr('src', '<?= base_url() ?>profile/' + hasil['foto']);

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

	var loadFile3 = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output1');
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
		data.append('alamat', $("[name='alamat']").val());

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
					$("[name='alamat']").val('')
					$("[name='gambar']").val('')



				} else {

					alert('Data Gagal dimasukan')
				}
			}
		});
	}

	function bayar() {
		var form = $('#forms_upload')[0];

		var data = new FormData();
		data.append('id_pesanan', $("[name='id_pesanan']").val());
		data.append('teknisi', $("[name='teknisi']").val());
		data.append('bukti_pembayaran', $('#bukti_pembayaran').prop('files')[0]);

		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'customer/dashboard/uploadBukti' ?>',
			data: data,
			contentType: false,
			cache: false,
			processData: false,
			success: function(hasil) {
				var json = $.parseJSON(hasil)
				console.log(json);
				location.reload()
				alert('Harap Menunggu Verifikasi Admin')
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
				// alert(data.length);
				// console.log(data.status)


				if (data.length < 1) {
					var baris = '';
					baris += '<tr>' +
						'<td colspan="5" class="text-center"> Tidak Ada Pesanan</td>' +

						'<tr>';
					$('#target').html(baris);
				} else {
					$('#btnTambah').hide();
					var baris = '';
					for (var i = 0; i < data.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td class="txt-oflo">' + data[i].nama_keluhan + '</td>' +
							'<td class="txt-oflo"><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + data[i].gambar + '></td>' +
							'<td class="txt-oflo">' + data[i].status + '</td>' +
							'<td class="txt-oflo"><button class="btn waves-effect waves-light btn-info" id="btnDetail" href="#detail_forms" data-toggle="modal" onclick="detail_pesanan(' + data[i].id_pesanan + ')"><i class="icofont icofont-info-square">cek Detail</i></button><button class="btn waves-effect waves-light btn-warning" id="btnTeknisi" href="#cek_teknisi" data-toggle="modal" onclick="cekTeknisi(' + data[i].id_pesanan + ')"><i class="icofont icofont-info-square">Cek Teknisi</i></button></td>'
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

				if (data['status'] == 'Diterima') {
					$('#btnKedatangan').show();
					$('#btnSelesai').hide();
					$('#btnBayar').hide();
				} else {
					$('#btnKedatangan').hide();
					$('#btnSelesai').hide();
					$('#btnBayar').hide();
				}
				if (data['status_pekerjaan'] == null) {
					var sp = 'Harap Menunggu'
				} else if (data['status_pekerjaan'] == 0) {
					var sp = 'Mulai Pekerjaan';
					$('#btnKedatangan').hide();
					$('#btnSelesai').show();
				} else {
					var sp = 'Selesai';
					$('#btnKedatangan').hide();
					$('#btnSelesai').hide();
					$('#btnBayar').show();

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

				if (data['barang_tambahan1'] == null) {
					var bt1 = ''
				} else {
					var bt1 = data['barang_tambahan1']
				}
				if (data['harga_tambahan1'] == null) {
					var ht1 = ''
				} else {
					var ht1 = data['harga_tambahan1']
				}
				if (data['barang_tambahan2'] == null) {
					var bt2 = ''
				} else {
					var bt2 = data['barang_tambahan2']
				}
				if (data['harga_tambahan2'] < 1) {
					var ht2 = ''
				} else {
					var ht2 = data['harga_tambahan2']
				}
				if (data['barang_tambahan3'] == null) {
					var bt3 = ''
				} else {
					var bt3 = data['barang_tambahan3']
				}
				if (data['harga_tambahan3'] < 1) {
					var ht3 = ''
				} else {
					var ht3 = data['harga_tambahan3']
				}

				$('#id_pesanan').val(data['id_pesanan']);
				$('#teknisi').val(data['teknisi']);
				$('[name="detail_keluhan"]').text(data['keluhan']);
				$('[name="detail_keluhan_detail"]').text(data['detail_keluhan']);
				$('[name="hasil"]').text(data['harga']);
				$('[name="status_pekerjaan_detail"]').text(sp);
				$('[name="jam_mulai_detail"]').text(jm);
				$('[name="jam_selesai_detail"]').text(js);
				// $('[name="nama_teknisi_detail"]').text(data['teknisi']);
				// $('[name="no_hp_teknisi_detail"]').text(data['no_hp']);
				$('#output_detail').attr('src', '<?= base_url() ?>gambar/' + data['gambar']);

				// Pembayaran Detail
				$('[name="barang_tambahan1"]').text(bt1);
				$('[name="harga_tambahan1"]').text(ht1);
				$('[name="barang_tambahan2"]').text(bt2);
				$('[name="harga_tambahan2"]').text(ht2);
				$('[name="barang_tambahan3"]').text(bt3);
				$('[name="harga_tambahan3"]').text(ht3);
				$('[name="total"]').text(data['total']);

			}
		});
	}

	function kedatangan() {
		let confirmAction = confirm("Apakah Teknisi Anda Sudah Datang? ")
		if (confirmAction) {
			var id_pesanan = $('#id_pesanan').val()
			alert(id_pesanan)
			$.ajax({
				type: 'POST',
				url: '<?= base_url() . "customer/dashboard/kedatangan" ?>',
				dataType: 'JSON',
				data: {
					'id_pesanan': id_pesanan,
				},
				success: function(data) {
					$('#detail_forms').modal('hide');
					alert('Terimakasih Telah melakukan verifikasi kedatangan Teknisi')
				}
			});
		} else {
			alert('Batal')
		}
	}

	function selesai() {
		let confirmAction = confirm("Apakah Teknisi Anda Sudah Selesai? ")
		if (confirmAction) {
			var id_pesanan = $('#id_pesanan').val()
			var teknisi = $('#teknisi').val()

			$.ajax({
				type: 'POST',
				url: '<?= base_url() . "customer/dashboard/selesai" ?>',
				dataType: 'JSON',
				data: {
					'id_pesanan': id_pesanan,
					'teknisi': teknisi,
				},
				success: function(data) {
					$('#detail_forms').modal('hide');
					alert('Terimakasih Telah melakukan verifikasi pekerjaan Teknisi')
				}
			});
		} else {
			alert('Batal')
		}
	}

	function verifikasi(x) {
		let confirmAction = confirm("Apakah Anda Yakin Memverifikasi Pekerjaan ini?");
		if (confirmAction) {
			var id_pesanan = $('#id_pesanan').val()
			var teknisi = $('#teknisi').val()
			$.ajax({
				type: 'post',
				url: '<?= base_url() . "customer/dashboard/verifikasi" ?>',
				dataType: 'json',
				data: {
					'id_pesanan': id_pesanan,
					'teknisi': teknisi,
					'verifikasi_selesai': x,
				},
				success: function(data) {
					alert('Pesanan Berhasil DI verfikasi')
				}
			});
		} else {
			alert('pesanan gagal diverifikasi')
		}
	}
</script>
