<?php
$ambil = $koneksi->query("SELECT * FROM supplyer WHERE id='$_GET[id]'");

$pecah = $ambil->fetch_assoc();


if (isset($_POST['ubah'])) {
    
    $koneksi->query("UPDATE supplyer SET nama='$_POST[nama]',hp='$_POST[hp]',alamat='$_POST[alamat]' WHERE id='$_GET[id]'");
    // print_r(mysqli_error($koneksi));
    // die;
    echo "<script>alert('Data telah diubah');</script>";
    echo "<script>location='index.php?halaman=supplyer';</script>";
}
?>
<h2>Ubah Supplyer</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Kode Supplyer</label>
        <input type="text" class="form-control" value="<?= $pecah['kode_supplyer'] ?>" readonly name="kode_supplyer">
    </div>
    <div class="form-group">
        <label>Nama Supplyer</label>
        <input type="text" value="<?= $pecah['nama'] ?>" class="form-control" name="nama">
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