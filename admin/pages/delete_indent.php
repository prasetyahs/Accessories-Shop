<?php 
$id = $_GET["id"];

// Query untuk menghapus data dari tabel indent
$query = "DELETE FROM indent WHERE id=$id";
if ($koneksi->query($query) === TRUE) {
  // echo "Data berhasil dihapus";
  echo "<script>location='index.php?halaman=indent';</script>";
} else {
  echo "Error: " . $query . "<br>" . $koneksi->error;
}