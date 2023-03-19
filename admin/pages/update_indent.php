<?php 
include "../../koneksi.php";
$id_barang = $_POST["id_barang"];
$id_konsumen = $_POST["id_konsumen"];
$sts_indent = $_POST["sts_indent"];
$sts_pemasangan = $_POST["sts_pemasangan"];
$tgl = $_POST["tgl"];
$jml = $_POST["jml"];
$id = $_GET['id'];
$query = "UPDATE indent SET id_barang='$id_barang', id_konsumen='$id_konsumen', jml='$jml', sts_indent='$sts_indent', sts_pemasangan='$sts_pemasangan', tgl='$tgl' WHERE id='$id'";

if ($koneksi->query($query) === TRUE) {
  echo "Data berhasil diubah";
  echo "<script>location='../index.php?halaman=indent';</script>";
} else {
  echo "Error: " . $query . "<br>" . $koneksi->error;
}