<h1>Daftar Barang Servis</h1>

<div class="col-md-12">
	<div class="panel panel-default ">
		<div class="panel-heading">
			<span id="success_message"></span>
			<a href="#formkeluhan" onclick="submit('tambah')" data-toggle="modal" class="btn btn-md btn-primary">Tambah data</a>
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
						<th scope="col">Nama Barang</th>
						<th scope="col">Grup</th>
						<th scope="col">Harga</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="target">

				</tbody>
			</table>

		</div>
	</div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="formkeluhan" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Form Pemesanan</h3>
			</div>
			<div class="modal-body form">
				<form id="form" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<input type="hidden" value="" id="id_keluhan" name="id_keluhan" />
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Nama Barang</label>
							<div class="col-md-9">
								<input class="form-control" placeholder="Nama Barang" id="nama_keluhan" name="nama_keluhan" required>
								<span id="nama_keluhan_error" class="text-danger"></span>


							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Pilih Grup</label>
							<div class="col-md-9">
								<select class="form-control" name="grup" id="grup">
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>

								</select>
								<span id="grup_error" class="text-danger"></span>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Harga</label>
							<div class="col-md-9">
								<input type="text" class="form-control" placeholder="Masukan Harga" id="harga_keluhan" name="harga_keluhan" required>
								<span id="harga_keluhan_error" class="text-danger"></span>

							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a type="button" id="btnSave" onclick="add()" class="btn btn-primary">Save</a>
				<a type="button" id="btnEdit" onclick="editData()" class="btn btn-warning">Edit</a>
				<a type="button" class="btn btn-danger" data-dismiss="modal">Cancel</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script>
	ambilKeluhan();

	function ambilKeluhan() {
		$.ajax({
			type: 'GET',
			url: '<?= base_url() . 'admin/keluhan/ambilKeluhan' ?>',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				var baris = '';
				for (var i = 0; i < data.length; i++) {
					baris += '<tr>' +
						'<td>' + (i + 1) + '</td>' +
						'<td>' + data[i].nama_keluhan + '</td>' +
						'<td>' + data[i].grup + '</td>' +
						'<td>' + "Rp. " + data[i].harga_keluhan + '</td>' +
						'<td><a onclick="destroy(' + data[i].id_keluhan + ')" class="btn btn-md btn-danger"><i class="fa fa-trash"></i><a onclick="submit(' + data[i].id_keluhan + ')" href="#formkeluhan" data-toggle="modal" class="btn btn-md btn-warning"><i class="fa fa-edit"></i></td>' +
						'<tr>';
				}
				$('#target').html(baris);
			}
		});
	}

	function submit(x) {
		if (x == 'tambah') {
			$('#btnSave').show();
			$('#btnEdit').hide();
			$("[name='nama_keluhan']").val('');
			$("[name='grup']").val('');
			$("[name='harga_keluhan']").val('');
		} else {
			$('#btnSave').hide();
			$('#btnEdit').show();

			$.ajax({
				type: 'POST',
				url: '<?= base_url() . 'admin/keluhan/getId' ?>',
				data: 'id_keluhan=' + x,
				dataType: 'json',
				success: function(hasil) {
					console.log(hasil);
					$('#id_keluhan').val(hasil['id_keluhan']);
					$('[name="nama_keluhan"]').val(hasil['nama_keluhan']);
					$('[name="grup"]').val(hasil['grup']);
					$('[name="harga_keluhan"]').val(hasil['harga_keluhan']);
				}
			});
		}
	}

	function editData() {
		// preventDefault();/
		var id_keluhan = $('#id_keluhan').val();
		var nama_keluhan = $('#nama_keluhan').val();
		var grup = $('#grup').val();
		var harga_keluhan = $('#harga_keluhan').val();
		// alert(id_keluhan)

		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'admin/keluhan/edit' ?>',
			data: {
				id_keluhan: id_keluhan,
				nama_keluhan: nama_keluhan,
				grup: grup,
				harga_keluhan: harga_keluhan
			},
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil.error)
				if (hasil.error == 0) {
					alert('Data sudah di ubah!')
					ambilKeluhan();
					$('#formkeluhan').modal('hide');

				} else {
					alert('Data gagal diubah!')
					ambilKeluhan();
					$('#formkeluhan').modal('hide');

				}

			}
		});
	}

	function add() {

		var nama_keluhan = $('#nama_keluhan').val();
		var grup = $('#grup').val();
		var harga_keluhan = $('#harga_keluhan').val();

		$.ajax({
			type: 'post',
			url: '<?= base_url() . 'admin/keluhan/add' ?>',
			dataType: "json",
			data: {
				nama_keluhan: nama_keluhan,
				grup: grup,
				harga_keluhan: harga_keluhan
			},
			success: function(hasil) {
				console.log(hasil)
				if (hasil.error) {
					if (hasil.nama_keluhan_error != "") {
						$('#nama_keluhan_error').html(hasil.nama_keluhan_error);
					} else {
						$('#nama_keluhan_error').html("");
					}
					if (hasil.grup_error != "") {
						$('#grup_error').html(hasil.grup_error);
					} else {
						$('#grup_error').html("");
					}
					if (hasil.harga_keluhan_error != "") {
						$('#harga_keluhan_error').html(hasil.harga_keluhan_error);
					} else {
						$('#harga_keluhan_error').html("");
					}
				}
				if (hasil.error == 0) {
					alert('Data sudah masuk!');
					ambilKeluhan()
					$('#nama_keluhan_error').html('');
					$('#grup_error').html('');
					$('#harga_keluhan_error').html('');
					$('#form')[0].reset();
					$('#formkeluhan').modal('hide');

				}
				$('#btnSave').attr('disabled', false);

			}
		});
	}

	function destroy(x) {
		let confirmAction = confirm("Apakah Anda Yakin Menghapus?");
		if (confirmAction) {
			$.ajax({
				type: 'post',
				url: '<?= base_url() . 'admin/keluhan/destroy' ?> ',
				data: 'id_keluhan=' + x,
				dataType: 'json',
				success: function(hasil) {
					ambilKeluhan();
					alert('sip mantap')
				}
			});
		} else {
			alert('Gagal hapus');
		}
	}
</script>
