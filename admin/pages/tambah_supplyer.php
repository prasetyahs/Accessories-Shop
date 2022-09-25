<?php


if (isset($_POST['save'])) {

	$kode = $_POST['kode_supplyer'];
	$nama = $_POST['nama'];
	$telepon = $_POST['hp'];
	$alamat = $_POST['alamat'];

	//query insert ke tabel pelanggan
	$koneksi->query("INSERT INTO supplyer (kode_supplyer,nama,hp,alamat)
		VALUES ('$kode','$nama','$telepon','$alamat') ");

	echo "<script>alert ('Supplyer Telah Ditambahkan')</script>";
	echo "<script>location='index.php?halaman=supplyer';</script>";
}
?>
<h2>Tambah Supplyer</h2>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kode Supplyer</label>
		<input type="text" class="form-control" name="kode_supplyer">
	</div>
	<div class="form-group">
		<label>Nama Supplyer</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>No Telepon</label>
		<input type="text" class="form-control" name="hp">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" id="" cols="30" rows="10"></textarea>
	</div>

	<button class="btn btn-primary" name=save>Simpan</button>

</form>