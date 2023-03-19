<?php
include "../../koneksi.php";
$id_barang = $_POST["id_barang"];
$id_konsumen = $_POST["id_konsumen"];
$sts_indent = $_POST["sts_indent"];
$sts_pemasangan = $_POST["sts_pemasangan"];
$jml = $_POST['jml'];
$tgl = $_POST["tgl"];

// Query untuk menambahkan data ke tabel indent
$query = "INSERT INTO indent (id_barang, id_konsumen,jml, sts_indent, sts_pemasangan, tgl) VALUES ('$id_barang', '$id_konsumen','$jml', '$sts_indent', '$sts_pemasangan', '$tgl')";
if ($koneksi->query($query) === TRUE) {
  echo "<script>alert ('Data Telah Ditambahkan')</script>";
  echo "<script>location='../index.php?halaman=indent';</script>";
} else {
  echo "Error: " . $query . "<br>" . $koneksi->error;
}
