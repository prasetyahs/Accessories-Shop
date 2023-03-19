<h2>Ubah Indent</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori");
$ambil_pelanggan = $koneksi->query("SELECT * FROM pelanggan");

$id_indent = $_GET['id'];
$ambil_indent = $koneksi->query("SELECT * FROM indent left join produk on indent.id_barang = produk.id_produk left join pelanggan on pelanggan.id_pelanggan = indent.id_konsumen where id = '$id_indent'");
$ambil_indent = $ambil_indent->fetch_assoc();
// print_r($ambil_indent['id_barang']);die;
?>
<form method="post" action="pages/update_indent.php?id=<?= $id_indent ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label>Barang</label>
        <select type="text" class="form-control" name="id_barang">
            <option value="">--Pilih---</option>
            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                <option <?= $ambil_indent['id_produk'] ==  $pecah['id_produk'] ? 'selected' : '' ?> value="<?= $pecah['id_produk'] ?>"><?= $pecah['nama_produk'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Konsumen</label>
        <select type="text" class="form-control" name="id_konsumen">
            <option value="">--Pilih---</option>
            <?php while ($pecah = $ambil_pelanggan->fetch_assoc()) { ?>
                <option <?= $ambil_indent['id_pelanggan'] ==  $pecah['id_pelanggan'] ? 'selected' : '' ?> value="<?= $pecah['id_pelanggan'] ?>"><?= $pecah['nama_pelanggan'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" value="<?= $ambil_indent['jml'] ?>" class="form-control" name="jml">
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
            <option>--Pilih--</option>
            <option value="Proses">Diproses</option>
            <option value="Barang Dipesan">Barang Dipesan</option>
            <option  value="Barang Dipesan" value="Selesai">Selesai</option>
        </select>
    </div>
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" value="<?= $ambil_indent['tgl'] ?>" class="form-control" name="tgl">
    </div>
    <button class="btn btn-primary" name=save>Simpan</button>

</form>