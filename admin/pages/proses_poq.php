<?php

$idbarang = $_GET['id'];
//fetch month and year
$data = "SELECT DISTINCT '*',MONTHNAME(tanggal_pembelian) as `Month` , ' ', YEAR(tanggal_pembelian) AS `Year` FROM pembelian left JOIN pembelian_produk on pembelian_produk.id_pembelian = pembelian.id_pembelian where status_pembelian='selesai'and pembelian_produk.id_produk = '$idbarang' ORDER BY tanggal_pembelian  ASC;";
$data = $koneksi->query($data);
$data = $data->fetch_all(MYSQLI_ASSOC);

//fetch pemakaian
$dataPemakaian = $koneksi->query("SELECT tanggal_pembelian,jumlah FROM  pembelian left JOIN pembelian_produk on pembelian_produk.id_pembelian = pembelian.id_pembelian where id_produk='$idbarang' order by tanggal_pembelian ASC");

$dataTrans  = array();

while ($a = $dataPemakaian->fetch_assoc()) {
    $month = explode('-',  $a['tanggal_pembelian'])[0] . "-" . explode('-',  $a['tanggal_pembelian'])[1];
    if (!isset($dataTrans[$month])) {
        $dataTrans[$month] = array();
    }
    $dataTrans[$month][] = $a['jumlah'];
}

$in = 0;
$array_permonth = [];
foreach ($dataTrans as $k => $v) {
    $array_permonth[$in] = array_sum($v);
    $in++;
}

$permintaan = $array_permonth;

$barang = "SELECT * FROM produk";
$barang = $koneksi->query($barang);
$barang = $barang->fetch_all(MYSQLI_ASSOC);
?>
<div class="row" style="margin-bottom: 20px;margin-top:10px">
    <div class="col-lg-12">
        <h6 for="">Pilih ID Barang : </h6>
        <?php foreach ($barang as $b) { ?>
            <a href="index.php?halaman=proses-poq&id=<?= $b['id_produk'] . "&pemesanan=" . $_GET['pemesanan'] . "&penyimpanan=" . $_GET['penyimpanan'] . "&bulan=" . $_GET['bulan'] ?>"><?= $b['id_produk'] . "     |" ?></a>
        <?php } ?>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Time Periode</th>
                    <th>Permintaan</th>
                    <th>Pemesanan</th>
                    <th>Stok</th>
                    <th>EOQ</th>
                    <th>R</th>
                    <th>RMSE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $j = 1;
                $eoqChart = [];
                $poqChart = [];
                $rArr = [];
                for ($i = 0; $i < count($data); $i++) { ?>
                    <?php
                    $eoq = ceil(sqrt(2 * $permintaan[$i] * $_GET['pemesanan'] / $_GET['penyimpanan']));
                    $r = $permintaan[$i] / 4;
                    $poq = ceil($permintaan[$i] / $r);
                    $rmse =  round(pow(($_GET['penyimpanan'] - $eoq), 2), 2);
                    ?>

                    <tr>
                        <td><?= $data[$i]['Month'] . " " . $data[$i]["Year"] ?></td>
                        <td><?= $permintaan[$i] ?></td>
                        <td><?= $_GET['pemesanan'] ?></td>
                        <td><?= $_GET['penyimpanan'] ?></td>
                        <td><?= $eoq ?></td>
                        <td><?= $r ?></td>
                        <td><?= $rmse ?></td>
                    </tr>
                <?php
                    array_push($eoqChart, $eoq);
                    array_push($poqChart, $poq);
                    array_push($rArr, $r);
                    $rmseTotal = +$rmse;
                    $j++;
                } ?>
                <tr>
                    <td colspan="6">Jumlah : </td>
                    <td><span style="font-weight:bold"><?= isset($rmseTotal) ? $rmseTotal : 0  ?></span> </td>
                </tr>
                <tr>
                    <td colspan="6">RMSE : </td>
                    <td><span style="font-weight:bold"><?= isset($rmseTotal) ? round(sqrt($rmseTotal / count($data)), 2) : 0 ?></span> </td>
                </tr>
            </tbody>
        </table>
        <div class="col-12 mt-5">
            <h2>Analisa Barang <?= $idbarang . " " . $_GET['bulan'] . " "  ?> Bulan Kedepan</h2>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="data-table table table-bordered table-md">
                    <thead>
                        <th>Time Periode</th>
                        <th>EOQ</th>
                        <th>R</th>
                        <th>RMSE</th>
                    </thead>
                    <tbody>
                        <?php
                        $tmpArrPOQ = [];
                        $tmpArrEOQ = [];
                        $labelsFuture = [];
                        $m = 1;
                        for ($i = 0; $i < $_GET['bulan']; $i++) {
                            if ($i == 0) {
                                $lastPermintaan = count($permintaan) > 0 ?  $permintaan[count($permintaan) - 1] : 0;
                                $tmpR = count($rArr) > 0 ?  $rArr[count($rArr) - 1] : 0;
                            }
                            $eoqFuture = sqrt(2 * $lastPermintaan * $_GET['pemesanan'] / $_GET['penyimpanan']);
                            if ($i > 0) {
                                $lastPermintaan = $eoqFuture;
                                $tmpR = $tmpR / 4;
                            }
                            $poqFuture = $eoqFuture != 0 && $tmpR != 0 ?  $eoqFuture / $tmpR : 0;
                            $rmseN =  round(pow(($lastPermintaan - $eoqFuture), 2), 2);
                            $dateString = count($data) > 0 ?  $data[count($data) - 1]["Year"] . "-" . $data[count($data) - 1]['Month'] : 0;
                            $date = strtotime($dateString);
                            $final = explode('-', date("Y-F", strtotime("+" . $m . " month", $date)));
                        ?>
                            <tr>
                                <td><?= $final[1] . " " . $final[0] ?></td>
                                <td><?= round($eoqFuture, 2) ?></td>
                                <td><?= round($tmpR, 2) ?></td>
                                <td><?= round($rmseN, 2) ?></td>
                            </tr>
                        <?php
                            $m++;
                            array_push($labelsFuture, $final[1] . " " . $final[0]);
                            array_push($tmpArrEOQ,   round($eoqFuture, 2));
                            array_push($tmpArrPOQ,  round($poqFuture, 2));
                            $rmseTotalFuture = +$rmseN;
                        } ?>
                        <tr>
                            <td colspan="3">Jumlah : </td>
                            <td><span style="font-weight:bold"></span><?= round($rmseTotalFuture, 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">RMSE : </td>
                            <td><span style="font-weight:bold"><?= isset($rmseTotalFuture) ? round(sqrt($rmseTotalFuture / $_GET['bulan']), 2) : 0 ?></span> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 mt-4">
            <h2>Grafik EOQ</h2>
            <canvas id="chartPrediksi" height="182"></canvas>
        </div>
    </div>
</div>