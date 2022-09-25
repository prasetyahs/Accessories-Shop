<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>

<body>

	<?php include 'menu.php'; ?>

	<section class="konten">
		<div class="container">

			<!--  Nota disalin dari nota di admin/detai.php -->
			<h2 id="hide-title">Detail Pembelian</h2>

			<?php
			$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
			$detail = $ambil->fetch_assoc();
			?>
			<!-- <h1>Data Orang Yang Beli $detail</h1>
<pre><?php print_r($detail); ?></pre>

<h1>Data Orang Yang Login di session</h1>
<pre><?php print_r($_SESSION) ?></pre> -->

			<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php, karena dia tidak berhak melihat nota orang lain -->
			<!-- pelanggan yang beli harus pelanggan yang login -->
			<?php
			// mendapat id_pelanggan yang beli
			$idpelangganbeli = $detail["id_pelanggan"];

			// mendapat id_pelanggan yang login
			$idpelangganlogin = $_SESSION["pelanggan"]["id_pelanggan"];

			if ($idpelangganbeli !== $idpelangganlogin) {
				echo "<script>alert('JANGAN NAKAL YA KAMU!!');</script>";
				echo "<script>location='riwayat.php';</script>";
				exit();
			}


			?>

			<div class="row">
				<div class="col-md-4">
					<h3 class="hide-title">Pembelian</h3>
					<strong>No. Pembelian : <?php echo number_format($detail['id_pembelian']); ?></strong><br>
					Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
					Metode Pembayaran : <?php echo $detail['pembayaran']; ?>


				</div>
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>

					<p>
						<?php echo $detail['telepon_pelanggan']; ?><br>
						<?php echo $detail['email_pelanggan']; ?>
					</p>
				</div>
				<div class="col-md-4">
					<h3>Pengiriman</h3>
					<strong><?php echo $detail['nama_kota']; ?></strong>
					Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?> <br>
					Alamat : <?php echo $detail['alamat_pengiriman']; ?>
				</div>
			</div>


			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<td>Harga</td>
						<td>Berat</td>
						<th>Jumlah</th>
						<th>Subberat</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1; ?>
					<?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
					<?php while ($pecah = $ambil->fetch_assoc()) { ?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['nama']; ?></td>
							<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
							<td><?php echo $pecah['berat']; ?> Kg.</td>
							<td><?php echo $pecah['jumlah']; ?></td>
							<td><?php echo $pecah['subberat']; ?> Kg.</td>
							<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
						</tr>
						<?php $nomor++; ?>
					<?php } ?>
				</tbody>
				<tr>
					<th colspan="6">Total Belanja</th>
					<th>Rp. <?php echo number_format($detail['total_pembelian']) ?></th>
				</tr>
			</table>

			<div class="row">
				<div class="col-lg-12">
					<div class="alert alert-info" id="alert">
						<p>
							<?php if ($detail['pembayaran'] == "transfer") : ?>
								Silahkan Melakukan Pembayaran Sebesar Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
								Dengan Keterangan : <br>
								<u> Pembayaran Produk Langgan Variasi Motor<br> Nomor Pembelian : <?php echo $detail['id_pembelian']; ?></u> <br>
								<strong> BANK ENTUT'S 137-0010027-3275 AN. LANGGAN VARIASI MOTOR</strong> <br>
								<?php $ambil1 = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");
								$cekpem = $ambil1->num_rows;
								if ($cekpem == 0) {
									echo "Lalu Silahkan <a href='pembayaran.php?id=" . $detail['id_pembelian'] . "'> Konfirmasi Pembayaran</a> atau";
								}
								?>
								Cek
								<a href="riwayat.php" ; ?>Riwayat Belanja</a>
							<?php else : ?>
								Untuk Pembayaran Ditempat <br>
								Silahkan Menghubungi Nomor <a target="_blank" href="http://wa.me/6282122254623"><u>082122254623</u></a> - Reza Eka Aditia <br>
								Untuk Konfirmasi Pesanan
							<?php endif ?>
						</p>
					</div>
					<!-- <div class="col-md-7">
				</div> -->
					<button class="btn btn-primary" id="hide-print" onclick="printdiv('konten')">Print Nota</button>
					<!-- <div class="col-md-7 d-flex justify-content-end">
				</div> -->
				</div>
			</div>

		</div>
	</section>
</body>
<script>
	function printdiv(printdivname) {
		document.getElementById("hide-print").style.display = "none";
		document.getElementById("hide-title").style.display = "none";
		var headstr = "<html><head><title>Booking Details</title></head><body>";
		var footstr = "</body>";
		var newstr = document.getElementsByClassName(printdivname)[0].innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr + newstr + footstr;
		window.print();
		document.body.innerHTML = oldstr;
		document.getElementById("hide-print").style.display = "inline-block";
		document.getElementById("hide-title").style.display = "inline-block";
		return false;
	}
</script>

</html>