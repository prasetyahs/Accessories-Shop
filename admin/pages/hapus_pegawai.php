<?php
// $koneksi = new mysqli("localhost","root","","toko");S
$id = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pegawai WHERE id=$id");
$pecah = $ambil->fetch_row();
if ($pecah == null) {
    echo "<script>alert('pegawai tidak ditemukan');</script>";
}
$koneksi->query("DELETE FROM pegawai WHERE id=$id");
echo "<script>alert('pegawai terhapus');</script>";
echo "<script>location='index.php?halaman=pegawai';</script>";
