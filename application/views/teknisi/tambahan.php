<div class="form-group row">
	<label class="col-sm-2 col-form-label">Barang Tambahan2</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="barang_tambahan2" id="barang_tambahan2" placeholder="Masukan Barang Tambahan">
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-2 col-form-label">Harga Tambahan2</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" value="0" name="harga_tambahan2" id="harga_tambahan2" placeholder="Masukan Harga">
	</div>
</div>
<a onclick="show()">show</a>

<div id="bt1">

</div>

<script>
	function show() {
		$.get("<?= base_url() . 'teknisi/dashboard/tambahan1' ?>", function(data) {
			$("#bt1").html(data);
		});
	}
</script>
