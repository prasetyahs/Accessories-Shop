
<form method="post" class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-md-3">Username</label>
		<div class="col-md-7">
			<input type="text" class="form-control" name="username" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3">Password</label>
		<div class="col-md-7">
			<input type="text" class="form-control" name="password" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3">Nama Lengkap</label>
		<div class="col-md-7">
			<input type="text" class="form-control" name="nama_lengkap" required>
		</div>
	<div class="form-group">
		<div class="col-md-7 col-md-offset-3">
			<br><button class="btn btn-primary" name="daftar">Daftar</button>
		</div>
	</div>
</form>
<?php 
					//jika ada tombol daftar / ditekan tombol daftar
					if (isset($_POST['daftar'])){

					// mengambil isian nama,email,password,alamat dan telepon
						$username = $_POST["username"];
						$password = $_POST["password"];
						$nama_lengkap = $_POST["nama_lengkap"];

						//query insert ke tabel pelanggan
						$koneksi->query	("INSERT INTO admin (username, password, nama_lengkap)
						VALUES ('$username','$password','$nama_lengkap') ");

							echo "<script>alert ('Admin Telah Ditambahkan')</script>";
							echo "<script>location='index.php?halaman=admin';</script>";
						}