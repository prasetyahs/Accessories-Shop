<?php
$barang = "SELECT * FROM produk";
$barang = $koneksi->query($barang);
$barang = $barang->fetch_all(MYSQLI_ASSOC);
?>
<h2>Input EOQ</h2>
<form method="get" action="index.php">
    <input type="hidden" value="proses-poq" name="halaman">
    <div class="form-group">
        <label>Analisa Berapa bulan kedepan</label>
        <input type="number" class="form-control" name="bulan">
    </div>
    <div class="form-group">
        <label>Jumlah Pemesan</label>
        <input type="number" class="form-control" name="pemesanan">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="penyimpanan">
    </div>
    <div class="form-group">
        <label>Pilih Produk</label>
        <select name="id" class="form-select form-control" aria-label="Default select example">
            <option selected>-- Pilih Produk --</option>
            <?php foreach ($barang as $b) { ?>
                <option value="<?= $b['id_produk'] ?>"><?= $b['nama_produk'] ?></option>
            <?php } ?>
        </select>
    </div>

    <button class="btn btn-primary" name=save>Proses</button>
</form>