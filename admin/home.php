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

// data grafik
$nunggu = $koneksi->query("SELECT * FROM pembelian WHERE status_pembelian = 'Menunggu Pembayaran' ");
$jml_nunggu = $nunggu->num_rows;
$proses = $koneksi->query("SELECT * FROM pembelian WHERE status_pembelian = 'proses' ");
$jml_proses = $proses->num_rows;
$selesai = $koneksi->query("SELECT * FROM pembelian WHERE status_pembelian = 'selesai' ");
$jml_selesai = $selesai->num_rows;
$batal = $koneksi->query("SELECT * FROM pembelian WHERE status_pembelian = 'batal' ");
$jml_batal = $batal->num_rows;



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
	<?php if ($_SESSION['admin']['username']=='owner') {
		echo '&nbsp; &nbsp; Grafik Status Pembelian<canvas id="oilChart" width="500" height="150"></canvas>';
	}
	?>
<div>
<script src="./assets/js/Chart.js"></script>
<script type="text/javascript">
		var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var oilData = {
    labels: [
        "Menunggu Pembayaran",
        "Proses",
        "Selesai",
        "Batal",
    ],
    datasets: [
        {
            data: [
            <?php echo $jml_nunggu ?>.0, 
            <?php echo $jml_proses ?>.0, 
            <?php echo $jml_selesai ?>.0, 
            <?php echo $jml_batal ?>.0],
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#8463FF",
                "#fe2f17",
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});
</script>
</div>