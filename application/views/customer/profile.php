<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.card {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			max-width: 300px;
			margin: auto;
			text-align: center;
			font-family: arial;
		}

		.title {
			color: grey;
			font-size: 18px;
		}

		button {
			border: none;
			outline: 0;
			display: inline-block;
			padding: 8px;
			color: white;
			background-color: #000;
			text-align: center;
			cursor: pointer;
			width: 100%;
			font-size: 18px;
		}

		a {
			text-decoration: none;
			font-size: 22px;
			color: black;
		}

		button:hover,
		a:hover {
			opacity: 0.7;
		}
	</style>
</head>

<body>

	<h2 style="text-align:center">User Profile Card</h2>

	<div class="card">
		<input type="hidden" id="id_user">
		<img id="profile" src="" alt="John" style="width:100%">
		<h1 id="username"></h1>
		<p class="title" id="email">CEO & Founder, Example</p>
		<p id="no_hp">Harvard University</p>
		<p id="alamat">Harvard University</p>
		<div style="margin: 24px 0;">
			<a href="#"><i class="fa fa-dribbble"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-facebook"></i></a>
		</div>
		<p><button id="button" value="" onclick="editData(this.value)">Edit Data</button></p>
	</div>

</body>

<!-- start modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<a type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<form action="" id="update">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" id="id_user_modal">
						<label for="exampleInputEmail1">Username</label>
						<input type="text" class="form-control" id="username_modal" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="text" class="form-control" id="email_modal" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">nomor Hp</label>
						<input type="text" class="form-control" id="no_hp_modal" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Alamat</label>
						<input type="text" class="form-control" id="alamat_modal" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
					<a id="btnUpdate" type="button" onclick="update(this.value)" class="btn btn-primary">Save changes</a>
				</div>
			</form>
		</div>
	</div>
</div>

</html>
<script>
	ambilData()

	function ambilData() {
		$.ajax({
			type: 'get',
			url: '<?= base_url() . "customer/Profile/ambilData" ?>',
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil.foto)
				$('#button').attr('value', hasil['id_user']);
				$('#username').text(hasil['username']);
				$('#email').text(hasil['email']);
				$('#no_hp').text(hasil['no_hp']);
				$('#alamat').text(hasil['alamat']);
				if (hasil.foto == null) {
					$('#profile').attr('src', '<?= base_url() ?>person.jpg');
				} else {
					$('#profile').attr('src', '<?= base_url() ?>profile/' + hasil['foto']);
				}

			}
		});
	}

	function editData(x) {
		$('#myModal').modal('show');
		$.ajax({
			type: 'get',
			url: '<?= base_url() . "customer/Profile/ambilData" ?>',
			dataType: 'json',
			success: function(hasil) {
				$('#id_user_modal').val(hasil['id_user']);
				$('#username_modal').val(hasil['username']);
				$('#email_modal').val(hasil['email']);
				$('#no_hp_modal').val(hasil['no_hp']);
				$('#alamat_modal').val(hasil['alamat']);
				$('#btnUpdate').attr('value', hasil['id_user']);

			}
		});
	}

	function update() {
		var id_user = $('#id_user_modal').val()
		var username = $('#username_modal').val()
		var email = $('#email_modal').val()
		var no_hp = $('#no_hp_modal').val()
		var alamat = $('#alamat_modal').val()

		$.ajax({
			type: 'POST',
			url: '<?= base_url() . 'customer/Profile/update' ?>',
			data: {
				'id_user': id_user,
				'username': username,
				'email': email,
				'no_hp': no_hp,
				'alamat': alamat,
			},
			dataType: 'json',
			success: function(hasil) {
				console.log(hasil)
				alert('Data Berhasil Di ubah')
				ambilData();
				$('#myModal').modal('hide');
			}
		});
	}
</script>