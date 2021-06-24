<h2>Data Pembelian</h2>

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
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian. id_pelanggan=pelanggan.id_pelanggan order by id_pembelian desc"); ?>
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