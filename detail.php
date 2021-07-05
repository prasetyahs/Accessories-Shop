<?php session_start(); ?>
<?php include 'koneksi.php'; ?>
<?php
// mendapatkan id_produk dari url
$id_produk = $_GET['id'];
$id_produk1 = $_GET['id'];

//query ambil data
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$sikat = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk1'");
$detail = $ambil->fetch_assoc();

// echo"<pre>";
// print_r($semua);
// echo"</pre>";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail Produk</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">

</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				  	<?php $i=0;while($perfoto = $sikat->fetch_assoc()): ?>
				    <div class="item <?php echo($i==0?'active':'') ?>">
				      <img src="foto_produk/<?php echo $perfoto['nama_produk_foto'] ?>" alt="...">
				      <div class="carousel-caption">
				      </div>
				    </div>
					<?php $i++;endwhile; ?>
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
			<div class="col-md-6">
				<h2><?php echo $detail["nama_produk"]; ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
				<h5>Stok : <?php echo $detail['stok_produk'] ?></h5>

				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" required>
							<div class="input-group-btn">
								<button class="btn btn-primary" id="beli" name="beli"><i class="glyphicon glyphicon-shopping-cart"></i>Beli</button>
							</div>
						</div>
					</div>
				</form>

				<?php 
				//jika ada tombol beli
				if (isset($_POST["beli"])) 
				{
					//mendapatkn di keranjang yg diinputkan
					$jumlah = $_POST["jumlah"];
					// masukan di keranjang belanja
					
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id_produk");
					$databarang = $ambil->fetch_assoc();
					if($databarang['stok_produk'] < $jumlah){
						 echo "<script>alert('Stok Produk Tidak Cukup');</script>";	
						 // return false;
					}else{
						$_SESSION["keranjang"][$id_produk] = $jumlah;
						echo "<script>alert('Produk Telah Masuk Ke Keranjang Belanja');</script>";
						echo "<script>location='keranjang.php';</script>";
					}


				}
				?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
			</div>
		</div>
	</div>
</section>
<script src="admin/assets/js/jquery-1.10.2.js"></script>
<script src="admin/assets/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript">
	document.querySelector('#beli').addEventListener('click', {
		alert('okok')
	})
</script> -->
</body>
</html>