<h1>EDIT DATA</h1>
<?= $this->session->flashdata('message'); ?>
<div class="panel panel-default">
	<div class="panel-heading">Forms</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form role="form" method="POST" action="<?= base_url('dashboard/editData') ?>" enctype="multipart/form-data" >
			<input type="hidden" name="id_button" value="<?= $isi['0']->id_pesanan ?>">
				<div class="form-group">
					<label>Nama Customer</label>
					<input class="form-control" placeholder="Placeholder" value="<?= $isi['0']->nama_customer ?>" name="nama_customer">
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input class="form-control" placeholder="Placeholder" value="<?= $isi['0']->alamat ?>" name="alamat">
				</div>
				<div class="form-group">
					<label>Pilih Keluhan</label>
					<select class="form-control" name="keluhan" id="keluhan" onchange="harga_keluhan()">
						<?php foreach ($keluhan as $row) : ?>
							<option value="<?= $row->id_keluhan ?>" data-id="<?= $row->id_keluhan ?>"><?= $isi['0']->keluhan ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Detail Keluhan</label>
					<textarea class="form-control" name="detail_keluhan"><?= $isi['0']->detail_keluhan ?></textarea>
				</div>
				<div class="form-group">
					<label>Gambar Barang</label>
					<input type="hidden" name="old_gambar" value="<?= $isi['0']->gambar ?>">
					<input type="file" name="gambar">
				</div>
				<div class="form-group">
					<label>Harga Servis</label>
					<input class="form-control" placeholder="Placeholder" name="harga" id="harga" value="<?= $isi['0']->harga ?>" readonly>
				</div>
				<button type="submit" value='upload' class="btn btn-primary">Submit Button</button>
				<button type="reset" class="btn btn-default">Reset Button</button>
		</div>
		</form>
	</div>
</div><!-- /.panel-->

<script>
	function harga_keluhan() {
		var x = document.getElementById('keluhan').value;
		$.ajax({
			url: '<?= base_url() ?>dashboard/cekHarga/' + x,
			success: function(result) {
				document.getElementById('harga').value = result;
			}
		});
	}
</script>
