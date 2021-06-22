<?php include "koneksi.php"; ?>
<?php 
$keyword = $_GET["keyword"];


$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

// echo "<pre>";
// print_r ($semuadata);
// echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pencarian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<style type="text/css">h3.produk-title {
    height: 100px;
}</style>
</head>
<body>
<?php include 'menu.php'; ?>
	<div class="container">
		<h3>Hasil Pencarian : <strong><?php echo $keyword ?></strong> </h3>

		<?php if (empty($semuadata)): ?>
			<div class="alert alert-danger"> Produk <strong><?php echo $keyword ?></strong> Tidak Ditemukan </div>
		<?php  endif ?>

		<div class="row">

			<?php foreach ($semuadata as $key => $value): ?>

			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $value['foto_produk']  ?>" alt="" class="img-responsive" style="width: 100%;height: 200px;">
					<div class="caption">
						<h3 class="produk-title"><?php echo $value["nama_produk"] ?></h3>
						<h5>RP. <?php echo number_format($value['harga_produk']) ?></h5>
						<a href="beli.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-primary">Beli</a>
						<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default">Detail</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>

</body>
</html>