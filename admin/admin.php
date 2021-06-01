<h2>Data Pelanggan</h2>

<table class="table table-bordered">
	<thead>
		<tr>

			<th>ID Admin</th>
			<th>Username</th>
			<th>Nama Lengkap</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>

		<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
		<?php while($pecah =$ambil->fetch_assoc()){ ?>
		<tr>

			<td><?php echo $pecah['id_admin']; ?></td>
			<td><?php echo $pecah['username']; ?></td>
			<td><?php echo $pecah['nama_lengkap']; ?></td>
			<td>
				<a href="" class="btn btin-danger">Hapus</a>
			</td>
		</tr>

	<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambah_admin" 

class="btn btn-primary square-btn-adjust">Tambah Admin</a>