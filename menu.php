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
      <a class="navbar-brand" href="index.php"><img src="admin/assets/img/me.jpg" width="30"></a>
    </div>

	<ul class="nav navbar-nav bs-example-navbar-collapse-1">
		<li><a href="index.php"></a></li>
		<li><a href="index.php">Home</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<li><a href="checkout.php">Checkout</a></li>
		<!-- Jika sudah login(ada sessuin pelanggan)-->
		<?php if (isset($_SESSION["pelanggan"])): ?>
		<li><a href="riwayat.php">Riwayat Belanja</a></li>
		<li><a href="profil.php?id=<?php echo $_SESSION['pelanggan']["id_pelanggan"] ?>"?>Profil</a></li>
		<li><a href="logout.php">Logout</a></li>
		<!-- selain itu(blm login)||blm ada session pelanggan -->
		<?php else: ?>
			<li><a href="login.php">Login</a></li>
			<li><a href="daftar.php">Daftar</a></li>
		<?php endif ?>
	</ul>

	<form action="pencarian.php" method="get" class="navbar-form navbar-right">
		<input type="text" class="form-control" name="keyword">
		<button class="btn btn-primary">Cari</button>
	</form>

	</div>
</nav>
<script src="admin/assets/js/jquery-1.10.2.js"></script>
<script src="admin/assets/js/bootstrap.min.js"></script>