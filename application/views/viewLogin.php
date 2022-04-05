<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Login</title>
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
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<?php echo form_open(base_url() . 'login/proses_login') ?>
					<form role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="USername" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							<?php if (isset($pesan)) {
								echo $pesan;
							}	?>
							</div>
							<button class="btn btn-primary">Login</button>
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

</html>