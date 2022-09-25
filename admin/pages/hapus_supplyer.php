<?php
// $koneksi = new mysqli("localhost","root","","toko");S
$id = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM supplyer WHERE id=$id");
$pecah = $ambil->fetch_row();
if ($pecah == null) {
    echo "<script>alert('supplyer tidak ditemukan');</script>";
}
$koneksi->query("DELETE FROM supplyer WHERE id=$id");
echo "<script>alert('supplyer terhapus');</script>";
echo "<script>location='index.php?halaman=supplyer';</script>";
