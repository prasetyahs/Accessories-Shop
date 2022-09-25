<?php
session_start();
include 'koneksi.php';



//jika belum ada session pelanggan(blm login) maka dilarikan ke login.php
if (!isset($_SESSION['pelanggan']))
{
	echo "<script>alert('Silagkan Login');</script>";
	echo "<script>location='login.php';</script>";
}

//jika checkout kosong maka dikembalikan ke home
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert(' Kamu Tuh Belum Belanja Tau, Yuk Belanja Dulu <3');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?>



<section class="konten">
	<div class="container">
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
				</tr>
			</thead>
			<body>
				<?php $nomor=1; ?>
				<?php $totalbelanja = 0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?> 
				<?php 
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id_produk");
				$databarang = $ambil->fetch_assoc();
				if($databarang['stok_produk'] < $jumlah){
					 echo "<script>alert('Stok Produk ".$databarang['nama_produk'] ." Tidak Cukup');</script>";	
					 unset($_SESSION['keranjang'][$id_produk]);
					 echo "<script>document.location.href='keranjang.php';</script>";
				}
				?>
				<!-- menalpilkan produk yang sedang diperulangan berdasarkan id_produk -->
				<?php
				$ambil = $koneksi->query("SELECT * FROM produk
					WHERE id_produk= $id_produk");
				$pecah = $ambil->fetch_assoc();
				$subharga = $pecah["harga_produk"]*$jumlah;
				//echo "<pre>";
				//print_r($pecah);
				//echo "</pre>";
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format ($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td><?php echo number_format($subharga); ?></td>	
				</tr>
			<?php $nomor++; ?>
			<?php $totalbelanja+=$subharga; ?>	
			<?php endforeach ?>
			</body>
		<tfoot>
			<tr>
				<th colspan="4">Total Belanja</th>
				<th>Rp. <?php echo number_format($totalbelanja) ?></th>
			</tr>
		</tfoot>
		</table>

		<form method="post">

			<div class="row">
				<div class="col-xs-3">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']?>" class="form-control">
					</div>
				</div>
				<div class="col-xs-3">
					<div class="form-group">
					<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?>" class="form-control">
					</div>
				</div>
				<div class="col-xs-3">
					<select class="form-control" name="pembayaran" id="pembayaran">
						<option value=""disabled selected hiden>Metode Pembayaran</option>
						<option value="transfer">Transfer</option>
						<option value="bayar_di_tempat">Bayar Di Tempat</option>
						<option value="ambil_sendiri">Ambil Sendiri</option>
					</select>
				</div>
				<div class="col-xs-3" id="ongkir">
					
				</div>
			</div>	
			<div class="form-group">
				<label>Alamat Lengkap Pengiriman</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan Alamat Lengkap Pengiriman (Termasuk Kode Pos)"></textarea>
			</div>
			<button class="btn btn-primary" name="checkout"><i class="glyphicon glyphicon-shopping-cart"></i>Buat Pesanan</button>
		</form>

		<?php 
		if (isset($_POST["checkout"]))
		{
			$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
			if(isset($_POST['id_ongkir'])){
				$id_ongkir = $_POST["id_ongkir"];
			}else{
				$id_ongkir = 0;
			}
			$tanggal_pembelian = date("Y-m-d");
			$alamat_pengiriman = $_POST['alamat_pengiriman'];
			$pembayaran = $_POST['pembayaran'];

			$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
			$arrayongkir = $ambil->fetch_assoc();
			$nama_kota = $arrayongkir['nama_kota'];
			$tarif = $arrayongkir['tarif'];

			$total_pembelian = $totalbelanja + $tarif;

			// 1. menyimpan data ke tabel pembelian
			$koneksi->query("INSERT INTO pembelian ( id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman,pembayaran)
				VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman','$pembayaran') " );
			
			//mendapatkan id_pembelian yg baru terjadi
			$id_pembelian_baru = $koneksi->insert_id;

			foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
			 {
			 	// mendapatkan data prudk dari id_produk
			 	$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
			 	$perproduk = $ambil->fetch_assoc();

			 	$nama = $perproduk['nama_produk'];
			 	$harga = $perproduk['harga_produk'];
			 	$berat = $perproduk['berat_produk'];
			 	$stoklama = $perproduk['stok_produk'];
			 	$stokbaru = $stoklama-$jumlah;

			 	$subberat = $perproduk['berat_produk']*$jumlah;
			 	$subharga = $perproduk['harga_produk']*$jumlah;
				$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
					VALUES ('$id_pembelian_baru','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah') ");

				//skrip update stok
				$koneksi->query("UPDATE produk SET stok_produk=$stokbaru WHERE id_produk='$id_produk'");
			}

			// mengosongkan keranjang belanja
			unset($_SESSION["keranjang"]);


			// tampilan dialihkan ke halaman nota, dari pembelian yg baru terjadi
			echo "<script>alert('Pembelian Telah Sukses');</script>";
			echo "<script>location='nota.php?id=$id_pembelian_baru';</script>";

		}
		?>
	</div>
</section>
<!-- <pre>
	<?php print_r($_SESSION["pelanggan"])?>
	<?php print_r($_SESSION["keranjang"])?>
</pre> -->

</body>
<script type="text/javascript">
	document.querySelector('#pembayaran').addEventListener('change' , function(e){
		if(e.target.value != 'ambil_sendiri'){
			document.querySelector('#ongkir').innerHTML = `<select class="form-control" name="id_ongkir">
						<option value=""disabled selected hiden>Pilih Ongkos Kirim</option>
						<?php
						$ambil = $koneksi->query("SELECT * FROM ongkir");
						while ($perongkir = $ambil->fetch_assoc()){
						?>
						<option value="<?php echo $perongkir["id_ongkir"] ?>">
								<?php echo $perongkir['nama_kota'] ?> -
							Rp. <?php echo number_format($perongkir['tarif']) ?>
						</option>
						<?php } ?>
					</select>`
		}else{
			document.querySelector('#ongkir').innerHTML = ''
		}
	})
</script>
</html>