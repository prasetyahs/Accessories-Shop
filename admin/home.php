<h2>Selamat Datang Di Administrator</h3>
<?php 

$kategori = $koneksi->query("SELECT * FROM kategori");
$jml_kategori = $kategori->num_rows;

$produk = $koneksi->query("SELECT * FROM produk");
$jml_produk = $produk->num_rows;

$pembelian = $koneksi->query("SELECT * FROM pembelian");
$jml_pembelian = $pembelian->num_rows;

$pelanggan = $koneksi->query("SELECT * FROM pelanggan");
$jml_pelanggan = $pelanggan->num_rows;

?>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default text-center"> 
			<div class="panel-heading">Jumlah Kategori</div>
			<div class="panel-body bg-success">
				<i class="fa fa-tags " style="font-size:30px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_kategori ?></h2>
			</div>
			<a href="index.php?halaman=kategori" ><div class="panel-footer" >Selengkapnya</div></a>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default text-center">
			<div class="panel-heading">Jumlah Produk</div>
			<div class="panel-body bg-info">
				<i class="fa fa-dropbox " style="font-size:30px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_produk ?></h2>
			</div>
			<a href="index.php?halaman=produk"><div class="panel-footer">Selengkapnya</div></a>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default text-center">
			<div class="panel-heading">Jumlah Pembellian</div>
			<div class="panel-body bg-warning">
				<i class="fa fa-list-alt " style="font-size:30px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_pembelian ?></h2>
			</div>
			<a href="index.php?halaman=pembelian"><div class="panel-footer">Selengkapnya</div></a>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default text-center">
			<div class="panel-heading">Jumlah Pelanggan</div>
			<div class="panel-body bg-danger">
				<i class="fa fa-user " style="font-size:30px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_pelanggan ?></h2>
			</div>
			<a href="index.php?halaman=pelanggan"><div class="panel-footer">Selengkapnya </div></a>
		</div>
	</div>
</div>