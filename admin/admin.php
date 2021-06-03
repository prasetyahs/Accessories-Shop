<h2>Data Admin</h2>

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
				<a href="index.php?halaman=hapus_admin&id=<?php echo $pecah['id_admin'] ?>" class="btn-danger btn"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
			</td>
		</tr>

	<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=tambah_admin" 

class="btn btn-primary square-btn-adjust">Tambah Admin</a>

