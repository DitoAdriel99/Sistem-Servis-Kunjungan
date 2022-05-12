<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		<h3> Laporan PDF Toko Kita</h3>
	</div>
	<table id="table">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal Pesanan</th>
				<th>Tanggal Perbaikan</th>
				<th>Nama Customer</th>
				<th>Barang</th>
				<th>Teknisi</th>
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
					<td><?= $val->tanggal_perbaikan ?></td>
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
