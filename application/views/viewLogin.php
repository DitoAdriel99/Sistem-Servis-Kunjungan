<?php echo form_open(base_url() . 'login/proses_login') ?>
<h1>Login</h1>

username <input type="text" name="username" required><br>
password <input type="password" name="password" required><br>
<input type="submit" value="LOGIN">

<?php if (isset($pesan)) {
	echo $pesan;
}	?>

<?= form_close()?>
