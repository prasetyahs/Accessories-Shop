<?php

$id_foto = $_GET['idfoto'];
$id_produk = $_GET["idproduk"];

//ambil data
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_foto' ");
$detalfoto = $ambilfoto->fetch_assoc();

$namafilefoto = $detalfoto["nama_produk_foto"];
//hapus file foto dari folder
unlink("../foto_produk/".$namafilefoto);


// echo "<pre>";
// print_r ($detalfoto);
// echo "</pre>";


// // menghapus data di database
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_foto' ");

echo "<script>alert('Foto Produk Sudah Terhapus');</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";


?>