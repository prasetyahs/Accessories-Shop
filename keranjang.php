<?php
session_start();


//echo "<pre>";
//print_r($_SESSION['keranjang']);
//echo "</pre>";

include 'koneksi.php';


if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert(' Keranjang Kosong, Seperti Hati Kamu. Yuk Belanja Dulu <3');</script>";
	echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja</title>
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
					<th>Aksi</th>
				</tr>
			</thead>
			<body>
				<?php $nomor=1; 
				?>

				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?> 
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
					<td><form method="post">
							<div class="form-group">
								<div class="input-group">
									<input data-id="<?= $id_produk ?>" id="update-stok"type="number" min="1" class="form-control" name="jumlah" value="<?php echo $jumlah; ?>" required>
								</div>
							</div>
						</form>
					</td>
					<td><?php echo number_format($subharga); ?></td>
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>hapus</a>
					</td>
					
				</tr>
			<?php $nomor++; ?>	
			<?php endforeach ?>
			</body>
		</table>

		<a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i>Lanjutkan Belanja</a>
		<a href="checkout.php" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i>Checkout</a>
	</div>
</section>

</body>
<script type="text/javascript">
	document.querySelector('#update-stok').addEventListener('change', async function(e){
		const id_pembelian = e.target.getAttribute('data-id');
		const jumblah = e.target.value;
		$.ajax({
			url: "./update-stok.php",
			data: {
				id_pembelian, jumblah
			},
			dataType: "JSON",
			type: "POST",
			success: function(res){
				if(res){
					location.reload();
				}
			}
		})
	})
</script>
</html>