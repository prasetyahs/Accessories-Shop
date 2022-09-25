<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login Dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Langgan Variasi Motor</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>


<?php include 'menu.php'; ?>

<!-- <pre><?php print_r($_SESSION) ?></pre> -->
<section class="riwayat">
	<div class="container">
		<h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?></h3>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$nomor=1;
				//mendapatkan ID pelanggan yang login dari session
				$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

				$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' order by id_pembelian desc");
				while($pecah = $ambil->fetch_assoc()) {
				?>
				<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah["tanggal_pembelian"];?></td>
				<td><?php echo $pecah["status_pembelian"] ;?> <br>
					
						<?php if(!empty($pecah['resi_pengiriman'])); ?>
						Resi: <?php  echo $pecah["resi_pengiriman"];?>
				</td>
				<td>Rp. <?php echo number_format($pecah["total_pembelian"]) ;?></td>
				<td>
					<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>
					<?php if ($pecah['status_pembelian']!=="batal"): ?>
					<?php if ($pecah['pembayaran']=="transfer"): ?>
					<?php if ($pecah['status_pembelian']=="Menunggu Pembayaran"): ?>
					<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?> " class="btn btn-success">
					Konfirmasi Pembayaran
					</a>
					<?php else: ?>
					<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
						Lihat Pembayaran
					</a>
				<?php endif ?>
				<?php endif ?>
				<?php endif ?>
				<?php if ($pecah['status_pembelian']=="Menunggu Pembayaran"): ?>
				<a href="batal_beli.php?id=<?php echo $pecah["id_pembelian"]; ?> " class="btn btn-danger">
					Batal Beli
					</a>
				<?php endif ?>
				</td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</tbody>
			</tbody>
		</table>
	</div>
</section>
</body>
</html>