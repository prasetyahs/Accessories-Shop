<h2>Data Produk</h2>
<div class="pull-left">
	<?php if (!array_key_exists('role', $session)) { ?>
		<a href="index.php?halaman=tambahproduk" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah Produk</a>
	<?php } ?>
</div>
<form action="pencarian.php" method="get" class="navbar-form navbar-right">
	<input type="text" class="form-control" name="keyword" required>
	<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</button>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>ID Produk</th>
			<th>Nama Produk</th>
			<th>Kategori</th>
			<th>Harga Beli(Rp)</th>
			<th>Harga Jual(Rp)</th>
			<th>Stok</th>
			<th>Berat</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor = 1; ?>
		<?php
		$keyword = @$_GET['keyword'];
		$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori");
		if (isset($keyword)) {
			$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE nama_produk LIKE '%$keyword%'");
		}
		?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['id_produk']; ?></td>
				<td><?php echo $pecah['nama_produk']; ?></td>
				<td><?php echo $pecah['nama_kategori']; ?></td>
				<td><?php echo number_format($pecah['harga_beli']); ?></td>
				<td><?php echo number_format($pecah['harga_produk']); ?></td>
				<td><?php echo $pecah['stok_produk']; ?></td>
				<td><?php echo $pecah['berat_produk']; ?> Kg.</td>
				<td>
					<img src="../foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
				</td>
				<td>
					<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
					<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
					<a href="index.php?halaman=detailproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
				</td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>