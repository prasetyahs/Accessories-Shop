<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container">
	
	<div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="admin/assets/img/fs.png" width="150"></a>
    </div>

	<ul class="nav navbar-nav bs-example-navbar-collapse-1">
		<li><a href="index.php"></a></li>
		<li><a href="keranjang.php"><i class="glyphicon glyphicon-shopping-cart"></i></a></li>
		<?php if (isset($_SESSION["pelanggan"])): ?>
		<li><a href="riwayat.php">Riwayat Belanja</a></li>
		<?php endif ?>
	</ul>
	
<ul class="nav navbar-nav bs-example-navbar-collapse-1 navbar-right">
		<li><form action="pencarian.php" method="get" class="navbar-form navbar-right">
		<input type="text" class="form-control" name="keyword" style="width: 400px;" required>
		<button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</button>
	</form></li>
		<!-- Jika sudah login(ada session pelanggan)-->
		<?php if (isset($_SESSION["pelanggan"])): ?>
		<li><a href="profil.php?id=<?php echo $_SESSION['pelanggan']["id_pelanggan"] ?>"?><i class="glyphicon glyphicon-user"></i></a></li>
		<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i></a></li>
		<li><a href=""><b>| <?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?></b></a></li>
		<!-- selain itu(blm login)||blm ada session pelanggan -->
		<?php else: ?>
			<li><a href="login.php">Login</a></li>
			<li><a href="daftar.php">Daftar</a></li>

		<?php endif ?>
	</ul>
	</div>
</nav>
	<script src="admin/assets/js/jquery-1.10.2.js"></script>
 <script src="admin/assets/js/bootstrap.min.js"></script>