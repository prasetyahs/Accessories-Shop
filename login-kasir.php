<?php
session_start();
$koneksi = new mysqli("localhost","root","","toko");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pegawai Langgan Variasi Motor</title>
	<!-- BOOTSTRAP STYLES-->
	<link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="admin/assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
	<div class="container">
		<div class="row text-center ">
			<div class="col-md-12">
				<br /><br />
				<h1>Langgan Variasi Motor</h1>
				<h3>Selamat Datang</h3>
				<h2>Akses Pegawai</h2>
				<br />
			</div>
		</div>
		<div class="row ">

			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong> Anda Harus Login Admin Dahulu </strong>  
					</div>
					<div class="panel-body">
						<form role="form" method="post">
							<br />
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
								<input type="text" class="form-control" name="user" />
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
								<input type="password" class="form-control"  name="pass" />
							</div>
							<button class="btn btn-primary" name="login">Login</button>
							<hr />
							
						</form>
						<?php
						if(isset($_POST['login']))
						{
							$ambil = $koneksi->query("SELECT * FROM pegawai WHERE username='$_POST[user]' AND password='$_POST[pass]'");
                            
							$yangcocok = $ambil->num_rows;
							if ($yangcocok==1)
							{	
								$data = $ambil->fetch_assoc();
								$data['role'] = "kasir";
								
								$_SESSION['admin']=$data;
								echo "<div class='alert alert-info'>Login Sukses</div>";
								echo "<meta http-equiv='refresh' content='1;url=admin/index.php'>"; 
							}
							else
							{
								echo "<div class='alert alert-danger'>Login Gagal</div>";
								echo "<meta http-equiv='refresh' content='1;url=login-kasir.php'>"; 	
							}
						}
						?>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script src="admin/assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="admin/assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="admin/assets/js/jquery.metisMenu.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="admin/assets/js/custom.js"></script>
</body>
</html>