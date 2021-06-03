<h2>Ubah Ongkir</h2>
<?php 
$ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Kota</label>
        <input type="text" name="namakota" class="form-control" value="<?php echo $pecah['nama_kota']; ?>">
    </div>
    <div class="form-group">
        <label>Tarif (Rp)</label>
        <input type="number" name="tarif" class="form-control" value="<?php echo $pecah['tarif']; ?>">
    </div>
    <div>
        <button class="btn btn-primary" name="ubah">Ubah</button>
    </div>
</form>

<?php
if(isset($_POST['ubah']))
{
        $koneksi->query("UPDATE ongkir SET nama_kota='$_POST[namakota]',tarif='$_POST[tarif]'
            WHERE id_ongkir='$_GET[id]'");  


    echo "<script>alert('Ongkir telah diubah');</script>";
    echo "<script>location='index.php?halaman=ongkir';</script>";
}
?>