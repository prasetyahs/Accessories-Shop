<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "toko");


if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda Harus Login Terlebih Dahulu');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}

$session = $_SESSION['admin'];

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Langgan Variasi Motor</a>
            </div>
            <div style="color: lightblue;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Selamat Datang, <strong><?= isset($_SESSION['admin']['nama_lengkap']) ? $_SESSION['admin']['nama_lengkap'] : $_SESSION['admin']['nama'] ?>&nbsp; | &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust"><i class="glyphicon glyphicon-log-out"></i></a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">

                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/logo.png" class="user-image img-responsive" />
                    </li>
                    <li>
                        <a href="index.php"><i class="fa fa-home "></i> Dashboard</a>
                    </li>
                    <?php if (!array_key_exists('role', $session)) { ?>
                        <li>
                            <a href="index.php?halaman=kategori"><i class="fa fa-tags"></i> Kategori</a>
                        </li>
                    <?php  } ?>
                    <li>
                        <a href="index.php?halaman=produk"><i class="fa fa-dropbox"></i> Produk</a>
                    </li>
                    <li>
                        <a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart"></i> Transaksi Pembelian</a>
                    </li>
                    <li>
                        <a href="index.php?halaman=laporan_pembelian"><i class="fa fa-list-alt"></i> Laporan</a>
                    </li>
                    <?php if (!array_key_exists('role', $session)) { ?>
                        <li>
                            <a href="index.php?halaman=supplyer"><i class="fa fa-users"></i> Supplyer</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=pegawai"><i class="fa fa-users"></i> Pegawai</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=pelanggan"><i class="fa fa-user"></i> Pelanggan</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=ongkir"><i class="fa fa-plane"></i> Ongkos Kirim</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=indent"><i class="fa fa-plane"></i> Indent</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=admin"><i class="fa fa-user"></i> Admin</a>
                        </li>
                        <li>
                            <a href="index.php?halaman=input-poq"><i class="fa fa-bar-chart-o"></i> EOQ</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman'])) {
                    if ($_GET['halaman'] == "produk") {
                        include 'produk.php';
                    } elseif ($_GET['halaman'] == "pembelian") {
                        include 'pembelian.php';
                    } elseif ($_GET['halaman'] == "pelanggan") {
                        include 'pelanggan.php';
                    } elseif ($_GET['halaman'] == "detail") {
                        include 'detail.php';
                    } elseif ($_GET['halaman'] == "tambahproduk") {
                        include 'tambahproduk.php';
                    } elseif ($_GET['halaman'] == "hapusproduk") {
                        include "hapusproduk.php";
                    } elseif ($_GET['halaman'] == "ubahproduk") {
                        include "ubahproduk.php";
                    } elseif ($_GET['halaman'] == "logout") {
                        include "logout.php";
                    } elseif ($_GET['halaman'] == "pembayaran") {
                        include "pembayaran.php";
                    } elseif ($_GET['halaman'] == "laporan_pembelian") {
                        include "laporan_pembelian.php";
                    } elseif ($_GET['halaman'] == "kategori") {
                        include "kategori.php";
                    } elseif ($_GET['halaman'] == "detailproduk") {
                        include "detailproduk.php";
                    } elseif ($_GET['halaman'] == "hapusfotoproduk") {
                        include "hapusfotoproduk.php";
                    } elseif ($_GET['halaman'] == "admin") {
                        include 'admin.php';
                    } elseif ($_GET['halaman'] == "tambah_admin") {
                        include 'tambah_admin.php';
                    } elseif ($_GET['halaman'] == "ongkir") {
                        include 'ongkir.php';
                    } elseif ($_GET['halaman'] == "hapus_admin") {
                        include "hapus_admin.php";
                    } elseif ($_GET['halaman'] == "hapus_pelanggan") {
                        include "hapus_pelanggan.php";
                    } elseif ($_GET['halaman'] == "hapus_ongkir") {
                        include "hapus_ongkir.php";
                    } elseif ($_GET['halaman'] == "ubah_ongkir") {
                        include "ubah_ongkir.php";
                    } elseif ($_GET['halaman'] == "hapus_kategori") {
                        include "hapus_kategori.php";
                    } elseif ($_GET['halaman'] == "ubah_kategori") {
                        include "ubah_kategori.php";
                    } elseif ($_GET['halaman'] == "tambah_ongkir") {
                        include "tambah_ongkir.php";
                    } elseif ($_GET['halaman'] == "tambah_kategori") {
                        include "tambah_kategori.php";
                    } elseif ($_GET['halaman'] == "pencarian") {
                        include "pencarian.php";
                    } elseif ($_GET['halaman'] == "supplyer") {
                        include "pages/supplyer.php";
                    } else if ($_GET['halaman'] == "pegawai") {
                        include "pages/pegawai.php";
                    } else if ($_GET['halaman'] == "tambah-supplyer") {
                        include "pages/tambah_supplyer.php";
                    } else if ($_GET['halaman'] == "hapus-supplyer") {
                        include "pages/hapus_supplyer.php";
                    } else if ($_GET['halaman'] == "ubah-supplyer") {
                        include "pages/ubah_supplyer.php";
                    } else if ($_GET['halaman'] == "tambah-pegawai") {
                        include "pages/tambah_pegawai.php";
                    } else if ($_GET['halaman'] == "hapus-pegawai") {
                        include "pages/hapus_pegawai.php";
                    } else if ($_GET['halaman'] == "ubah-pegawai") {
                        include "pages/ubah_pegawai.php";
                    } else if ($_GET['halaman'] == "proses-poq") {
                        include "pages/proses_poq.php";
                    } else if ($_GET['halaman'] == "input-poq") {
                        include "pages/input_poq.php";
                    } else if ($_GET['halaman'] == "input-index") {
                        include "pages/input_indent.php";
                    } else if ($_GET['halaman'] == "indent") {
                        include "pages/indent.php";
                    } else if ($_GET['halaman'] == "hapus-indent") {
                        include "pages/delete_indent.php";
                    } else if ($_GET['halaman'] == "add-indent") {
                        include "pages/add-indent.php";
                    } else if ($_GET['halaman'] == "ubah-indent") {
                        include "pages/ubah_indent.php";
                    }
                } else {
                    include 'home.php';
                }
                ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labelsJson = <?= json_encode($data) ?>;
        labels = [];
        labelsJson.forEach(element => {
            labels.push(element.Month)
        });
        const data = {
            labels: labels,
            datasets: [{
                label: 'EOQ',
                data: <?= json_encode($eoqChart) ?>,
                fill: false,
                backgroundColor: "#4676e8",
                borderColor: '#4676e8',
                tension: 0.1
            }]
        };
        const config = {
            type: 'line',
            data: data,
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );



        const labelsJsonPred = <?= json_encode($labelsFuture) ?>;
        labelsPred = [];
        labelsJsonPred.forEach(element => {
            labelsPred.push(element.Month)
        });

        const dataPred = {
            labels: labelsJsonPred,
            datasets: [{
                label: 'EOQ',
                data: <?= json_encode($tmpArrEOQ) ?>,
                fill: false,
                backgroundColor: "#4676e8",
                borderColor: '#4676e8',
                tension: 0.1
            }]
        };
        const configPred = {
            type: 'line',
            data: dataPred,
            options: {
                scales: {
                    y: {
                        suggestedMin: 2,
                        suggestedMax: 10
                    }
                }
            }
        };
        new Chart(
            document.getElementById('chartPrediksi'),
            configPred
        );
    </script>

</body>

</html>