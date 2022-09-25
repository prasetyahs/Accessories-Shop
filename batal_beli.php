<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika tidak ada session pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login Dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();
$pembelian_produk = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$idpem'");
// print_r($pembelian_produk->fetch_all());die;

while ($pemproduk = $pembelian_produk->fetch_assoc()) {
	// print_r($pemproduk['id_produk']);
	$id_produk = $pemproduk['id_produk'];
	$produk = $koneksi->query("SELECT * FROM produk WHERE id_produk=$id_produk");
	$stok_produk = $produk->fetch_assoc()['stok_produk'];
	$stok_produk_pembelian = $pemproduk['jumlah'];
	$total_stok = $stok_produk + $stok_produk_pembelian;
	$update_produk = $koneksi->query("UPDATE produk SET stok_produk=$total_stok WHERE id_produk=$id_produk");
	$update_status = $koneksi->query("UPDATE pembelian SET status_pembelian='batal' WHERE id_pembelian=$idpem");
}

echo "<script>alert('Pembelian berhasil dibatalkan');</script>";
echo "<script>location='riwayat.php';</script>";

// echo "<pre>";
// print_r($detpem);
// print_r($_SESSION);
// echo "</pre>";

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli)
{
	echo "<script>alert('Nakal Ya Lihat Yang Lain - Lain, Balik!!');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>