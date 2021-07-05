<?php 
session_start();
include 'koneksi.php';
$jumblah = $_POST['jumblah'];
$id_pembelian = $_POST['id_pembelian'];
unset($_SESSION['keranjang'][$id_pembelian]);
$_SESSION['keranjang'][$id_pembelian] = $jumblah;

echo json_encode(true);

