<?php
session_start();
//koneksi ke database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>

	<title>Toko Fauzan Sparepart</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="admin/assets/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="admin/assets/DataTables/datatables.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<br>
<br>
<?php include 'menu.php'; ?>

<div class="container">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images1.jpg" alt="">
    </div>

    <div class="item">
      <img src="images2.png" alt="">
    </div>

    <div class="item">
      <img src="images.png" alt="">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
</div>

<!-- konten -->
<section class="konten">
	<div class="container">
		<br>
				<a class= "btn btn-danger" href="katalog.pdf"><i class=" glyphicon glyphicon-eye-open"></i>  Lihat Katalog Toko</a>
		<h1>Produk Terbaru</h1>

		<div class="row">

			<?php
			  $batas = 4;
				$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
				$Previous = $halaman - 1;
				$next = $halaman + 1;
				$previous = $halaman - 1;
				$next = $halaman + 1;
			 $ambil = $koneksi->query("SELECT * FROM Produk order by id_produk desc"); 
			 $jumlah_data = mysqli_num_rows($ambil);
			 	$total_halaman = ceil($jumlah_data / $batas);
			 	$data_barang = mysqli_query($koneksi,"SELECT * from Produk order by id_produk desc limit $halaman_awal, $batas ");
			 	$nomor = $halaman_awal+1;
			 ?>

			<?php while($perproduk = $data_barang->fetch_assoc()){ ?>
			
			<div class="col-md-3" style="margin-bottom: 10px;">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="..." style="width: 100%;height: 200px;">
				</div>
				<div class="caption">
					<h3 class="produk-title"><?php echo $perproduk['nama_produk']; ?></h3>
					<h5>Rp<?php echo number_format($perproduk['harga_produk']); ?></h5>
					<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i>Beli Sekarang</a>
					<a href="detail.php?id=<?php echo $perproduk["id_produk"] ?>" class="btn btn-primary"><i class=" glyphicon glyphicon-eye-open"></i>Detail</a>
				</div> 
			</div>		
			<?php } ?>
		</div>
					<nav>
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$Previous'"; } ?>>Previous</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
				</li>
			</ul>
		</nav>
	</div>

</section>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d291.88723480081717!2d107.01031598044236!3d-6.349579285936168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69918e83cf3e83%3A0xf6ddcc60da237901!2sGubug%20Dzeko%20581%20becipok!5e0!3m2!1sid!2sid!4v1622550903913!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
<div class="bg-info">
	<div class="container ">
		<div class="row" style="padding: 7em 0;">
			<div class="col-md-3">
				<h3> <a href="index.php">FAUZAN SPAREPART</a></h3>
				<p> | Copyright © 2021 | </p>
				<img src="admin/assets/img/me.jpg" width="100">
			</div>
			<div class="col-md-3">
				<h3>LOKASI</h3>
				<p> Bengkel : <br> Jalan Pengairan 37 Blok D No 103,  <br> Kel. Sumur Batu, Kec. Bantar Gebang, Kota Bekasi, Provinsi Jawa Barat <br>
				Buka Jam 08.00 - 21.00
				</p>
			</div>
			<div class="col-md-3">
				<h3>INFORMASI LENGKAP</h3>
				<p>Whatsapp : <a href="http://wa.me/081286169627" target="_blank">081286169627</a>  <br> Email : <a href="mailto:fauzanzakaria45@gmail.com">fauzanzakaria45@gmail.com</a></p>
			</div>
			<div class="col-md-3">
				<h3>MEDIA SOSIAL</h3>
				<a href="https://www.facebook.com/trijoko.santoso"  target="_blank"><i class="fa fa-facebook-square"></i></a>
				<a href=""><i class="fa fa-twitter-square"></i></a>
				<a href="https://www.instagram.com/fauzanoz_/" target="_blank"><i class="fa fa-instagram"></i></a>
			</div>
		</div>
	</div>
</div>


</body>
</html>