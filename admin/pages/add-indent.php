<h2>Tambah Indent</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori");
$ambil_pelanggan = $koneksi->query("SELECT * FROM pelanggan");

?>
<form method="post" action="pages/create_indent.php" enctype="multipart/form-data">
    <div class="form-group">
        <label>Barang</label>
        <select type="text" class="form-control" name="id_barang">
            <option value="">--Pilih---</option>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <option value="<?= $pecah['id_produk'] ?>"><?= $pecah['nama_produk'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Konsumen</label>
        <select type="text" class="form-control" name="id_konsumen">
            <option value="">--Pilih---</option>
            <?php while ($pecah = $ambil_pelanggan->fetch_assoc()) { ?>
                <option value="<?= $pecah['id_pelanggan'] ?>"><?= $pecah['nama_pelanggan'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" class="form-control" name="jml">
    </div>
    <div class="form-group">
        <label>Status Indent</label>
        <select type="text" class="form-control" name="sts_indent">
            <option value="Proses Indent">--Pilih--</option>
            <option value="Proses Indent">Proses Indent</option>
            <option value="Tersedia">Tersedia</option>
        </select>
    </div>
    <div class="form-group">
        <label>Status Pemasangan</label>
        <select type="text" class="form-control" name="sts_pemasangan">
            <option value="Proses Indent">--Pilih--</option>
            <option value="Diproses">Proses Indent</option>
            <option value="Barang Dipesan">Barang Dipesan</option>
            <option value="Selesai">Selesai</option>
        </select>
    </div>
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" class="form-control" name="tgl">
    </div>
    <button class="btn btn-primary" name=save>Simpan</button>

</form>