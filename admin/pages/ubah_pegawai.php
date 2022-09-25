<?php


$ambil = $koneksi->query("SELECT * FROM pegawai WHERE id='$_GET[id]'");

$pecah = $ambil->fetch_assoc();


if (isset($_POST['ubah'])) {
    $username = $_POST['username'];

    $telepon = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $jenisKelamin = $_POST['jk'];
    $nama = $_POST['nama'];

    $koneksi->query("UPDATE pegawai SET username='$username',hp='$telepon',alamat='$alamat',jk='$jenisKelamin',nama='$nama' where id = '$_GET[id]'");
    // print_r(mysqli_error($koneksi));
    // die;
    echo "<script>alert('Data telah diubah');</script>";
    echo "<script>location='index.php?halaman=pegawai';</script>";
}
?>
<h2>Ubah Pegawai</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Username</label>
        <input type="text" value="<?= $pecah['username'] ?>" readonly class="form-control" name="username">
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" value="<?= $pecah['nama'] ?>" class="form-control" name="nama">
    </div>
    <div class="form-group d-flex justify-content-center">
        <label>Jenis Kelamin</label>
        <div class="form-check form-check-inline">
            <input <?= $pecah['jk'] === "Laki-Laki" ?  "checked" : ''  ?> name="jk" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Laki-Laki">
            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
        </div>
        <div class="form-check form-check-inline">
            <input <?= $pecah['jk'] === "Perempuan" ? "checked" : ''  ?> name="jk" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Perempuan">
            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
        </div>
    </div>
    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" value="<?= $pecah['hp'] ?>" class="form-control" name="hp">
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" name="alamat" id="" cols="30" rows="10"><?= $pecah['alamat'] ?></textarea>
    </div>

    <button class="btn btn-primary" name=ubah>Simpan</button>

</form>