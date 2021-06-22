<?php
session_start();
?>
<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ubah Data Pelanggan</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; 

$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Email Pelanggan</label>
        <input type="email" name="emailpelanggan" class="form-control" value="<?php echo $pecah['email_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Password Pelanggan</label>
        <input type="text" name="passwordpelanggan" class="form-control" value="<?php echo $pecah['password_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Nama Pelanggan</label>
        <input type="text" name="namapelanggan" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Telepon Pelanggan</label>
        <input type="number" name="teleponpelanggan" class="form-control" value="<?php echo $pecah['telepon_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Alamat Pelanggan</label>
        <input type="text" name="alamatpelanggan" class="form-control" value="<?php echo $pecah['alamat_pelanggan']; ?>">
    </div>
    <div>
        <button class="btn btn-primary" name="ubah">Ubah</button>
    </div>
</form>

<?php
if(isset($_POST['ubah']))
{
        $koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[namapelanggan]',password_pelanggan='$_POST[passwordpelanggan]',telepon_pelanggan='$_POST[teleponpelanggan]',email_pelanggan='$_POST[emailpelanggan]',alamat_pelanggan='$_POST[alamatpelanggan]'
            WHERE id_pelanggan='$_GET[id]'");  


    echo "<script>alert('Data Pelanggan Telah Di Ubah');</script>";
    echo "<script>location='profil.php?id=".$_GET[id]."';</script>";
}
?>