<h2>Detail Pembelian</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan 
	WHERE pembelian.id_pembelian='$_GET[id]'");

$ambil2 = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$_GET[id]'");

$detail = $ambil->fetch_assoc();
$detail2 = $ambil2->fetch_assoc();
?>
<!-- <pre><?php print_r($detail); ?></pre> -->


<div class="row">
		<div class="col-md-4">
			<h3>Pembelian</h3>
			<strong>No. Pembelian : <?php echo number_format($detail['id_pembelian']); ?></strong><br>
			Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
			Total : Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
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
		Status: <?php echo $detail["status_pembelian"]; ?> <br>
		Alamat : <?php echo $detail['alamat_pengiriman']; ?>
		</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<td>Harga</td>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk 
		WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				Rp. <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
	<tr>
			<th colspan="4">Total Belanja</th>
			<th>Rp. <?php echo number_format($detail['total_pembelian']) ?></th>
	</tr>
</table>
<div class="col-md-6">
				<img src="../bukti_pembayaran/<?php echo $detail2["bukti"] ?>" alt="" class="img-responsive" width="300" >