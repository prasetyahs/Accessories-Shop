<h2>Selamat Datang Di Dashboard Toko</h3> <br>
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

//grafik batang
$query_namaproduk = $koneksi->query("SELECT * FROM pembelian_produk GROUP BY nama");
while ($data_namaproduk = $query_namaproduk->fetch_assoc()) {
	$nama_produk[] = $data_namaproduk['nama'];
	$nm_prd = $data_namaproduk['nama'];
	$query_jmlh = $koneksi->query("SELECT SUM(jumlah) as total_jumlah FROM pembelian_produk WHERE nama='$nm_prd'");
	$jumlah_pembelian[] = $query_jmlh->fetch_assoc()['total_jumlah'];

}
// print_r($jumlah_pembelian);die;
?>
    <div class="col-md-3">
		<div class="panel panel-default text-center">
			<a href="index.php?halaman=kategori">
			<div class="panel-body bg-success">
            Jumlah Kategori
				<i class="fa fa-tags " style="font-size:100px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_kategori ?></h2>
			</div>
			</a>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-default text-center">
			<a href="index.php?halaman=produk">
			<div class="panel-body bg-info">
				Jumlah Produk
				<i class="fa fa-dropbox " style="font-size:100px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_produk ?></h2>
			</div>
			</a>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-default text-center">
			<a href="index.php?halaman=pembelian">
			<div class="panel-body bg-warning">
				Jumlah Pembelian
				<i class="fa fa-shopping-cart" style="font-size:100px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_pembelian ?></h2>
			</div>
			</a>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="panel panel-default text-center">
			<a href="index.php?halaman=pelanggan">
				<div class="panel-body bg-danger">
			Jumlah Pelanggan
			
				<i class="fa fa-user " style="font-size:100px;float:left;"></i>
				<h2 style="float:right;margin:0;"><?php echo $jml_pelanggan ?></h2>
			</div>
			</a>
		</div>
	</div> 
	<?php if ($_SESSION['admin']['username']=='Reza') {
		echo '&nbsp; &nbsp; Grafik Status Pembelian<canvas id="oilChart" width="500" height="150"></canvas>
			&nbsp; &nbsp; Grafik Penjualan Produk<canvas id="myChart"></canvas>';
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

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: ["<?php echo implode('","', $nama_produk) ?>"],
            datasets: [{
                label:'Data Penjualan Produk ',
                backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#8463FF",
                "#fe2f17",
                "#f9d100",
                "#73d4f5",
                "#702c16",
                "#303262",
                "#f7448b",
                "#ed6a40",
                ], 
                borderColor: ['rgb(255, 99, 132, 86, 56, 388)'],
                data: [<?php echo implode(',', $jumlah_pembelian) ?>]
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
</div>
