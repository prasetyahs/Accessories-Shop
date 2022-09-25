<?php


if (isset($_POST['save'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $telepon = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $jenisKelamin = $_POST['jk'];
    $nama = $_POST['nama'];

    //query insert ke tabel pelanggan
    $koneksi->query("INSERT INTO pegawai (username,password,hp,alamat,jk,nama)
		VALUES ('$username','$password','$telepon','$alamat','$jenisKelamin','$nama') ");

    echo "<script>alert ('Pegawai Telah Ditambahkan')</script>";
    echo "<script>location='index.php?halaman=pegawai';</script>";
}
?>
<h2>Tambah Pegawai</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input  class="form-control" type="password" name="password">
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group d-flex justify-content-center">
        <label>Jenis Kelamin</label>
        <div class="form-check form-check-inline">
            <input name="jk" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Laki-Laki">
            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="jk" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Perempuan">
            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
        </div>
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