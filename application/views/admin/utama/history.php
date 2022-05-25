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
		<h3> Laporan Perbaikan di QhmService</h3>
	</div>

	<a onclick="cetak()">Cetak PDF</a>
	<table id="table">
		<thead>
			<tr>
				<th width="10px">No.</th>
				<th width="150px">Tanggal Pesanan</th>
				<th width="150px">Tanggal Perbaikan</th>
				<th width="150px">Nama Customer</th>
				<th width="150px">Teknisi</th>	
				<th width="150px">Barang Perbaikan</th>
				<th width="100px">Harga</th>
				<th width="100px">Mulai</th>
				<th width="100px">selesai</th>
			</tr>
		</thead>
		<tbody id="target">
			
		</tbody>
	</table>
</body>

</html>

<script>
	ambilData()
	function cetak() {
		$.ajax({
			type: 'post',
			url: '<?= base_url() . '/Pdfview' ?>',
			success: function(result) {
				console.log(result)
			}
		});
	}

	function ambilData(){
		$.ajax({
			type: 'get',
			url: '<?= base_url() . '/admin/history/laporan' ?>',
			dataType: 'json',
			success: function(data){
				console.log(data)
				if (data.length < 1) {
					var baris = '';
					baris += '<tr>' +
						'<td colspan="9" class="text-center"> Data Tidak Ada</td>' +
						'<tr>';
					$('#target').html(baris);
				} else {
					var baris = '';
					for (var i = 0; i < data.length; i++) {
						baris += '<tr>' +
							'<td scope="row">' + (i + 1) + '</td>' +
							'<td>' + data[i].tanggal_pesanan + '</td>' +
							'<td>' + data[i].tanggal_perbaikan + '</td>' +
							'<td>' + data[i].nama_customer + '</td>' +
							'<td>' + data[i].username + '</td>' +
							'<td>' + data[i].nama_keluhan + '</td>' +
							// '<td>' + data[i].barang_tambahan + '</td>' +
							'<td>' + data[i].harga + '</td>' +
							'<td>' + data[i].jam_mulai + '</td>' +
							'<td>' + data[i].jam_selesai + '</td>' +		
							'<tr>';
					}
					$('#target').html(baris);
				}
			}
		})
	}
</script>
