<h2>Data Pembelian</h2>
<form action="pencarian.php" method="get" class="navbar-form navbar-right">
		<input type="text" class="form-control" name="keyword" required>
		<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</button>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Pelanggan</th>
			<th>Tanggal</th>
			<th>Status Pembelian</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php
		$keyword = @$_GET['keyword'];
		$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan order by id_pembelian desc"); 
		if (isset($keyword)) {
			$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE nama_pelanggan LIKE '%$keyword%' order by id_pembelian desc");
		}
		?>
		<?php while($pecah = $ambil->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_pelanggan']; ?></td>
				<td><?php echo $pecah['tanggal_pembelian']; ?></td>
				<td><?php echo $pecah['status_pembelian']; ?></td>
				<td><?php echo $pecah['total_pembelian']; ?></td>
				<td>
					<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i>Detail</a>

					<?php if ($pecah['status_pembelian']!=='batal'): ?>
						<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success"><i class="glyphicon glyphicon-credit-card"></i>Cek Pembayaran</a>
				<?php endif ?>
				</td>
			</tr>
		<?php $nomor++; ?>	
		<?php } ?>
	</tbody>
</table>