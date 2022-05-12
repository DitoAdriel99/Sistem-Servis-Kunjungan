<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PT.QHM</title>
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/datepicker3.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Selamat Datang Silahkan Log in</div>
				<div class="panel-body">
					<?php echo form_open(base_url() . 'login/proses_login') ?>
					<form role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Masukan Username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Masukan Password" name="password" type="password" value="">
								<?php if (isset($pesan)) {
									echo $pesan;
								}	?>
							</div>
							<button class="btn btn-primary">Login</button>
							<div class="form-group">
								<a href="#formRegister" data-toggle="modal">Register</a>
							</div>
						</fieldset>
					</form>
				</div>

				<?= form_close() ?>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->


	<script src="<?= base_url() ?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
</body>

<!-- Bootstrap modal -->
<div class="modal fade" id="formRegister" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Register</h3>
				<div class="alert alert-danger print-error-msg" style="display:none">
				</div>
				<div class="modal-body form">
					<span id="success_message"></span>
					<form method="post" id="contact_form">
						<div class="form-group">
							<input type="text" name="username" id="username" class="form-control" placeholder="username" />
							<span id="username_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email Address" />
							<span id="email_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="no_hp">
							<span id="no_hp_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control" placeholder="password">
							<span id="password_error" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="submit" name="contact" id="contact" class="btn btn-info" value="Daftar">
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div>

</html>

<script>
	var loadFile1 = function(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('output1');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}


	$(document).ready(function() {
		$('#contact_form').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: "<?php echo base_url(); ?>Login/validation",
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function(data) {
					console.log(data)
					if (data.error) {
						if (data.username_error != '') {
							$('#username_error').html(data.username_error);
						} else {
							$('#username_error').html('');
						}
						if (data.email_error != '') {
							$('#email_error').html(data.email_error);
						} else {
							$('#email_error').html('');
						}
						if (data.password_error != '') {
							$('#password_error').html(data.password_error);
						} else {
							$('#password_error').html('');
						}
						if (data.no_hp_error != '') {
							$('#no_hp_error').html(data.no_hp_error);
						} else {
							$('#no_hp_error').html('');
						}
					}
					if (data.error == 0) {
						alert('Terimakasih Sudah daftar Silahkan Login!')
						$('#username_error').html('');
						$('#email_error').html('');
						$('#password_error').html('');
						$('#no_hp_error').html('');
						$('#contact_form')[0].reset();
						$('#formRegister').modal('hide');
					}
				}
			})
		});

	});
</script>
