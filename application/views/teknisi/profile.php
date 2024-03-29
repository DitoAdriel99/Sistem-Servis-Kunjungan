<style>
	.card {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		transition: 0.3s;
		width: 300px;
	}

	.card:hover {
		box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
	}

	.container {
		padding: 2px 1px;
	}
</style>
<h1>Profile</h1>

<div class="container">

	<div class="row">
		<div class="card">
			<img src="<?= base_url() . "/person.jpg" ?>" alt="Avatar" style="width:100%">
			<div class="container">
				<input type="hidden" name="id_user" id="id_user" value="" />
				<h4 id="username"><b>John Doe</b></h4>
				<p>Grup: <span id="grup"></span> </p>
				<p>Status: <span id="status"></span> </p>
				<a type="button" id="btnHadir" onclick="status(1)" class="btn btn-primary">Hadir</a>
				<a type="button" id="btnIzin" onclick="status(2)" class="btn btn-warning">Tidak Hadir</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<h1>History Pekerjaan</h1>
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
</div>

<script>
	ambilProfile()
	ambilData()

	function ambilProfile() {
		$.ajax({
			type: 'GET',
			url: '<?= base_url() . '/teknisi/profile/ambilProfile' ?>',
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil)
				if (hasil['status'] == 0) {
					var sts = 'Sedang Tugas';
					$('#btnHadir').hide();
					$('#btnIzin').hide();

				} else if (hasil['status'] == 1) {
					var sts = 'Tersedia';
					$('#btnHadir').hide();
					$('#btnIzin').show();
				} else {
					var sts = 'Tidak Hadir';
					$('#btnHadir').show();
					$('#btnIzin').hide();
				}
				$('#username').text(hasil['username']);
				$('#grup').text(hasil['grup']);
				$('#status').text(sts);
				$('#id_user').val(hasil['id_user']);
			}
		});
	}

	function ambilData() {
		$.ajax({
			type: 'get',
			url: '<?= base_url() . '/teknisi/profile/AmbilData' ?>',
			dataType: 'json',
			success: function(data) {
				console.log(data)
				var baris = '';
				for (var i = 0; i < data.length; i++) {
					baris += '<tr>' +
						'<td>' + (i + 1) + '</td>' +
						'<td>' + data[i].nama_customer + '</td>' +
						'<td>' + data[i].alamat + '</td>' +
						'<td>' + data[i].nama_keluhan + '</td>' +
						'<td>' + data[i].detail_keluhan + '</td>' +
						'<td><img alt="Paris" width="100" height="100"; src=<?= base_url('gambar/') ?>' + data[i].gambar + '></td>' +
						'<tr>';
				}
				$('#target').html(baris);
			}
		});
	}

	function status(x) {
		var id_user = $('#id_user').val()
		$.ajax({
			type: 'post',
			url: '<?= base_url() . 'teknisi/profile/status' ?>',
			dataType: 'JSON',
			data: {
				'id_user': id_user,
				'status': x,
			},
			success: function(hasil) {
				console.log(hasil.error)
				if (hasil.error == 0) {
					alert('Terimaskasih Sudah konfirmasi');
					ambilProfile();
				} else {
					alert('Gagal Konfirmasi');
					ambilProfile();
				}
			}
		});
	}
</script>
