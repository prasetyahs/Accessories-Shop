<h2>Ongkis Kirim</h2>

<table class="table table-bordered">
	<thead>
		<tr>

			<th>ID Ongkir</th>
			<th>Nama Kota</th>
			<th>Tarif</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

		<?php $ambil=$koneksi->query("SELECT * FROM ongkir"); ?>
		<?php while($pecah =$ambil->fetch_assoc()){ ?>
		<tr>

			<td><?php echo $pecah['id_ongkir']; ?></td>
			<td><?php echo $pecah['nama_kota']; ?></td>
			<td><?php echo $pecah['tarif']; ?></td>
			<td>
				<a href="index.php?halaman=ubah_ongkir&id=<?php echo $pecah['id_ongkir'] ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i>Ubah</a>
				<a href="index.php?halaman=hapus_ongkir&id=<?php echo $pecah['id_ongkir'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Hapus</a>
			</td>
		</tr>

	<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambah_ongkir" 

class="btn btn-primary square-btn-adjust">Tambah Ongkir</a>