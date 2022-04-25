<h1>Semua Pesanan</h1>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?= base_url() ?>assets/js/jquery-1.11.1.min.js"></script>

	<title><?= $title_pdf; ?></title>
	<style>
		#table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#table td,
		#table th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#table tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		#table tr:hover {
			background-color: #ddd;
		}

		#table th {
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: left;
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>

<body>
	<div style="text-align:center">
		<h3> Laporan Perbaikan di QhomeService</h3>
	</div>

	<a onclick="cetak()">Cetak PDF</a>
	<table id="table">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal Perbaikan</th>
				<th>Nama Customer</th>
				<th>Keluhan</th>
				<th>teknisi</th>
				<th>Harga</th>
				<th>Mulai</th>
				<th>selesai</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($history as $val) : ?>
				<tr>
					<td scope="row"><?= $val->id_pesanan ?></td>
					<td><?= $val->tanggal_pesanan ?></td>
					<td><?= $val->nama_customer ?></td>
					<td><?= $val->nama_keluhan ?></td>
					<td><?= $val->username ?></td>
					<td>Rp.<?= $val->harga ?></td>
					<td><?= $val->jam_mulai ?></td>
					<td><?= $val->jam_selesai ?></td>

				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>

</html>

<script>
	function cetak() {
		$.ajax({
			type: 'post',
			url: '<?= base_url() . '/Pdfview' ?>',
			success: function(result) {
				console.log(result)
			}
		});
	}
</script>
