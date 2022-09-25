
<form method="post" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-md-3">Kategori</label>
        <div class="col-md-7">
            <input type="text" class="form-control" name="nama_kategori" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-7 col-md-offset-3">
            <br><button class="btn btn-primary" name="tambah_kategori">Tambah Kategori</button>
        </div>
    </div>
</form>
<?php 
                    //jika ada tombol daftar / ditekan tombol daftar
                    if (isset($_POST['tambah_kategori'])){

                    // mengambil isian nama,email,password,alamat dan telepon
                        $namakategori = $_POST["nama_kategori"];
                        //query insert ke tabel pelanggan
                        $koneksi->query("INSERT INTO kategori (nama_kategori)
                        VALUES ('$namakategori')");

                            echo "<script>alert ('Kategori Telah Ditambahkan')</script>";
                            echo "<script>location='index.php?halaman=kategori';</script>";
                        }
?>