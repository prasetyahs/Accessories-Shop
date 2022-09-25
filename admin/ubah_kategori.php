<h2>Ubah Kategori</h2>
<?php 
$ambil=$koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="namakategori" class="form-control" value="<?php echo $pecah['nama_kategori']; ?>">
    </div>
    <div>
        <button class="btn btn-primary" name="ubah">Ubah</button>
    </div>
</form>

<?php
if(isset($_POST['ubah']))
{
        $koneksi->query("UPDATE kategori SET nama_kategori='$_POST[namakategori]'
            WHERE id_kategori='$_GET[id]'");  


    echo "<script>alert('Kategori telah diubah');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";
}
?>