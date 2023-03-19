<h2>Data Indent</h2>
<div class="pull-left">
    <a href="index.php?halaman=add-indent" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah Data Indent </a>
</div>
<form action="pencarian.php" method="get" class="navbar-form navbar-right">
    <input type="text" class="form-control" name="keyword" required>
    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Konsumen</th>
            <th>Jumlah</th>
            <th>Status Indent</th>
            <th>Status Pemasangan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php
        $keyword = @$_GET['keyword'];
        $ambil = $koneksi->query("SELECT * FROM indent left join produk on indent.id_barang = produk.id_produk left join pelanggan on pelanggan.id_pelanggan = indent.id_konsumen;");
        if (isset($keyword)) {
            $ambil = $koneksi->query("SELECT * FROM indent left join produk on indent.id_barang = produk.id_produk left join pelanggan on pelanggan.id_pelanggan = indent.id_konsumen WHERE nama LIKE '$keyword%'");
        }

        ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama_produk']; ?></td>
                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                <td><?php echo $pecah['jml']; ?></td>
                <td><?php echo $pecah['sts_indent']; ?></td>
                <td><?php echo $pecah['sts_pemasangan']; ?></td>
                <td><?php echo $pecah['tgl']; ?></td>
                <td>
                    <a href="index.php?halaman=hapus-indent&id=<?php echo $pecah['id']; ?>" class="btn-danger btn"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                    <a href="index.php?halaman=ubah-indent&id=<?php echo $pecah['id']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>