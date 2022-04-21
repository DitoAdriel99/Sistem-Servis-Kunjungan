<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>A simple, clean, and responsive HTML invoice template</title>

	<!-- Favicon -->
	<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

	<!-- Invoice styling -->
	<style>
		.stamp {
			transform: rotate(12deg);
			color: #555;
			font-size: 3rem;
			font-weight: 700;
			border: 0.25rem solid #555;
			display: inline-block;
			padding: 0.25rem 1rem;
			text-transform: uppercase;
			border-radius: 1rem;
			font-family: 'Courier';
			-webkit-mask-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/8399/grunge.png');
			-webkit-mask-size: 944px 604px;
			mix-blend-mode: multiply;
		}

		.is-approved {
			color: #0A9928;
			border: 0.5rem solid #0A9928;
			-webkit-mask-position: 13rem 6rem;
			transform: rotate(-14deg);
			border-radius: 0;
		}

		body {
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			text-align: center;
			color: #777;
		}

		body h1 {
			font-weight: 300;
			margin-bottom: 0px;
			padding-bottom: 0px;
			color: #000;
		}

		body h3 {
			font-weight: 300;
			margin-top: 10px;
			margin-bottom: 20px;
			font-style: italic;
			color: #555;
		}

		body a {
			color: #06f;
		}

		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
			border-collapse: collapse;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}
	</style>
</head>

<body>
	<div class="invoice-box">
		<table>
			<tr class="top">
				<?php if($data['0']->verifikasi_pembayaran == null){ ?>

					<span class="stamp">Menunggu Konfirmasi</span>

					<?php }else{ ?>

						<span class="stamp is-approved">LUNAS</span>
					<?php } ?>

				<td colspan="2">
					<table>
						<tr>
							<td class="title">
								<img src='<?= base_url() . "/logo/logoQhome.png" ?>' alt="Company logo" style="width: 100%; max-width: 300px" />
							</td>

							<td>
								Invoice #: <?= $data['0']->id_pesanan ?><br />
								Dibuat: <?= $data['0']->tanggal_pesanan ?><br />
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="information">
				<td colspan="2">
					<table>
						<tr>
							<td>
								PT.Bangunan Jaya Mandiri<br />
								Jln xxxxxxxx<br />
								No, TX 12345
							</td>

							<td>
								Nama Customer: <?= $data['0']->nama_customer ?><br />
								Alamat: <?= $data['0']->alamat ?><br />
								No Hp : <?= $data['0']->no_hp ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			

			<!-- <tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr> -->

			<tr class="heading">
				<td>Bukti Barang Selesai</td>

				<td></td>
			</tr>

			<tr class="item">
				<td><img src="<?= base_url('gambar/' . $data['0']->gambar_pekerjaan ) ?>" alt=""></td>

			</tr>

			<tr class="heading">
				<td>Perbaikan</td>

				<td>Price</td>
			</tr>

			<tr class="item">
				<td><?= $data['0']->nama_keluhan ?></td>

				<td>Rp.<?= $data['0']->harga ?></td>
			</tr>

			<tr class="total">
				<td></td>

				<td>Total: Rp.<?= $data['0']->harga ?></td>
			</tr>
		</table>
	</div>
</body>

</html>
