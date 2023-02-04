<?php
// $koneksi = new mysqli("localhost","root","","toko");S
$id = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id");
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_produk'];

if (file_exists("../foto_produk/$fotoproduk")) {
	unlink("../foto_produk/$fotoproduk");
}

$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk=$id");
$ambilfoto = $ambilfoto->fetch_assoc();

if (count($ambilfoto) > 0) {
	foreach ( $ambilfoto as $gambar) {
		$namagambar = $gambar->nama_produk_foto;
		if (file_exists("../foto_produk/$namagambar")) {
			unlink("../foto_produk/$namagambar");
		}
	}
}
$hapus = $koneksi->query("DELETE FROM produk WHERE id_produk={$id}");
// var_dump($hapus);
// echo '<br>';
$hapus1 = $koneksi->query("DELETE FROM produk_foto WHERE id_produk=$id");
// var_dump($hapus1);

echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";
// header("Location:index.php?halaman=produk");
