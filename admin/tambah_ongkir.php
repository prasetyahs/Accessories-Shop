
<form method="post" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-md-3">Nama kota</label>
        <div class="col-md-7">
            <input type="text" class="form-control" name="nama_kota" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Tarif</label>
        <div class="col-md-7">
            <input type="text" class="form-control" name="tarif" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-7 col-md-offset-3">
            <br><button class="btn btn-primary" name="daftar">Tambah Data Ongkir</button>
        </div>
    </div>
</form>
<?php 
                    //jika ada tombol daftar / ditekan tombol daftar
                    if (isset($_POST['daftar'])){

                    // mengambil isian nama,email,password,alamat dan telepon
                        $namakota = $_POST["nama_kota"];
                        $tarif = $_POST["tarif"];

                        //query insert ke tabel pelanggan
                        $koneksi->query("INSERT INTO ongkir (nama_kota, tarif)
                        VALUES ('$namakota','$tarif')");

                            echo "<script>alert ('Ongkit Telah Ditambahkan')</script>";
                            echo "<script>location='index.php?halaman=ongkir';</script>";
                        }
?>