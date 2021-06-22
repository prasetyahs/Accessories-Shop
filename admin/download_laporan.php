<?php
include '../koneksi.php';

require_once '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$semuadata = array();

$tgl_mulai = "";
$tgl_selesai = "";
$status = "";
// echo "<pre>";
// print_r ($_GET);
// echo "</pre>";

$tgl_mulai = $_GET["tglm"];
$tgl_selesai = $_GET['tgls'];
$status = $_GET['status'];
$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE status_pembelian='$status' AND tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[]=$pecah;
	}

	$isi = '<style>
	table,th,td {
		font-size: 12px;
		border: 1px solid black;
		border-collapse : collapse;
		padding: 5px;
	}
	</style>
	
	<div class="headlaporan">
	<img src="./assets/img/me.jpg" Width="100" style="float: left; margin-right:20px; height: 100px">

	<div style="margin-left :20px">
		<div style="font-size : 18px"> Laporan Pembelian | Mulai '.date("d F Y",strtotime($tgl_mulai)).' Hingga '.date("d F Y",strtotime($tgl_selesai)).'
		<br>
		<font size="7">FAUZAN SPAREPART</font>
		<br>
		Jl.Pengairan No.103, Bantar Gebang, Kota Bekasi,17154 </div>
		

	</div>
	</div>

	<table Width= "100%" class="table table-bordered" border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>';

	?>
	<?php $total=0; ?>
	<?php foreach ($semuadata as $key => $value): ?>
	<?php $total+=$value['total_pembelian'];
	$nomor = $key+1;
		$isi.= '<tr>

			<td> '.$nomor.' </td>
			<td> '.$value["nama_pelanggan"].' </td>
			<td> '.date("d F Y",strtotime($value["tanggal_pembelian"])).' </td>
			<td>Rp. '.number_format($value["total_pembelian"]).',00</td>
			<td> '.$value["status_pembelian"].' </td>
		</tr>'; ?>
	<?php endforeach;
	$isi.= '</tbody>
	<tfoot>

		 <tr>
			 <th colspan="3">Total. </th>
			 <th colspan="2">Rp. '.number_format($total).'</th>
			 <th></th>
		 </tr>
	 </tfoot>
 	</table>

 	<br>
 	<br>
 	<br>

 	<div style="float:right;text-align:center;Width:200px">
 	Jakarta, '.date('d M Y').'

 	<br>
 	<br>
 	<br>
 	<br>
 	<br>

 	Fauzan Zakaria
 	</div>

 	';
// echo $isi;
$mpdf->WriteHTML($isi);
$mpdf->Output('Laporan_Toko_Fauzan_Sparepart.pdf', \Mpdf\Output\Destination::DOWNLOAD);