<h1>List Pesanan</h1>
<div class="col-md-6">
	<div class="panel panel-default ">
		<div class="panel-heading">
			On Going
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>
		<div class="panel-body timeline-container" style="display: block;">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Customer</th>
						<th scope="col">Keluhan</th>
						<th scope="col">Gambar</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<tbody id="ongoing">

				</tbody>
			</table>

		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="panel panel-default ">
		<div class="panel-heading">
			Verifikasi Pembayaran
			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
		</div>
		<div class="panel-body timeline-container" style="display: block;">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Customer</th>
						<th scope="col">Keluhan</th>
						<th scope="col">Gambar</th>
						<th scope="col">Bukti Selesai</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody id="data-pembayaran">

				</tbody>
			</table>

		</div>
	</div>
</div>

<script>
	onGoing();
	dataPembayaran()

	function onGoing() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() ?>admin/pesanan/onGoing/',
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil);
				if (hasil.length < 1) {
					var baris = '';
					baris += '<tr>' +
						'<td colspan="5" class="text-center"> Data Tidak Ditemukan</td>' +

						'<tr>';
					$('#ongoing').html(baris);

				} else {

					var baris = '';
					for (var i = 0; i < hasil.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td>' + hasil[i].nama_customer + '</td>' +
							'<td>' + hasil[i].nama_keluhan + '</td>' +
							'<td><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + hasil[i].gambar + '></td>' +
							'<td>' + hasil[i].status + '</td>' +
							'<tr>';
					}
					$('#ongoing').html(baris);
				}
			}
		});
	}

	function dataPembayaran() {
		$.ajax({
			type: 'POST',
			url: '<?= base_url() ?>admin/pesanan/dataPembayaran',
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil);
				if (hasil.length < 1) {
					var baris = '';
					baris += '<tr>' +
						'<td colspan="5" class="text-center"> Data Tidak Ditemukan</td>' +

						'<tr>';
					$('#data-pembayaran').html(baris);
				} else {
					var baris = '';
					for (var i = 0; i < hasil.length; i++) {
						baris += '<tr>' +
							'<td>' + (i + 1) + '</td>' +
							'<td>' + hasil[i].nama_customer + '</td>' +
							'<td>' + hasil[i].nama_keluhan + '</td>' +
							'<td><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + hasil[i].gambar + '></td>' +
							'<td><a href="<?= base_url('gambar/') ?>' + hasil[i].bukti_pembayaran + '" class="link" target="_blank">Card link</a></td>' +
							'<td><a onclick="verifikasi(' + hasil[i].id_pesanan + ')" class="btn btn-md btn-success"><i class="fa fa-handshake-o"></i></td>' +
							'<tr>';
					}
					$('#data-pembayaran').html(baris);
				}
			}
		});
	}

	function verifikasi(x) {
		let confirmAction = confirm("Apakah Anda Yakin Memverifikasi Pembayaran ini");
		if (confirmAction) {
			$.ajax({
				type: 'POST',
				url: '<?= base_url() ?>admin/pesanan/verifikasi',
				data: 'id_pesanan=' + x,
				dataType: 'json',
				beforeSend: function(){
					location.reload();
					alert("Terimakasih Verifikasi Berhasil Dilakukan");
				},
				success: function(hasil) {
					console.log(hasil);
					
				}
			});
		} else {
			alert("Verifikasi Di batalkan");
		}


	}
</script>
