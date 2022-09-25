<h2>Data Supplyer</h2>
<div class="pull-left">
    <a href="index.php?halaman=tambah-supplyer" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-plus"></i> Tambah Supplyer</a>
</div>
<form action="pencarian.php" method="get" class="navbar-form navbar-right">
    <input type="text" class="form-control" name="keyword" required>
    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Supplyer</th>
            <th>Nama Supplyer</th>
            <th>No telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php
        $keyword = @$_GET['keyword'];
        $ambil = $koneksi->query("SELECT * FROM supplyer");
        if (isset($keyword)) {
            $ambil = $koneksi->query("SELECT * FROM supplyer WHERE kode_supplyer LIKE '%$keyword%'");
        }
        ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['kode_supplyer']; ?></td>
                <td><?php echo $pecah['nama']; ?></td>
                <td><?php echo $pecah['hp']; ?></td>
                <td><?php echo $pecah['alamat']; ?></td>
                <td>
                    <a href="index.php?halaman=hapus-supplyer&id=<?php echo $pecah['id']; ?>" class="btn-danger btn"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                    <a href="index.php?halaman=ubah-supplyer&id=<?php echo $pecah['id']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
                </td>
            </tr>
            <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>