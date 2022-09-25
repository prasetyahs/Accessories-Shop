<?php
include '../koneksi.php';
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('B2','Laporan Keseluruhan Pembelian Toko Langgan Variasi Motor');
$sheet->setCellValue('A5', 'No');
$sheet->setCellValue('B5', 'Nama Pelanggan');
$sheet->setCellValue('C5', 'Tanggal');
$sheet->setCellValue('D5', 'Total Pembelian');
$sheet->setCellValue('E5', 'Status Pembelian');

$query = mysqli_query($koneksi,"SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan");
$i = 6;
$no = 1;
while($row = mysqli_fetch_array($query))
{
	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row["nama_pelanggan"]);
	$sheet->setCellValue('C'.$i, date("d F Y",strtotime($row["tanggal_pembelian"])));
	$sheet->setCellValue('D'.$i, 'Rp. '.number_format($row["total_pembelian"]).',00');	
	$sheet->setCellValue('E'.$i, $row["status_pembelian"]);	
	$i++;
}

$styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
$i = $i - 1;
$sheet->getStyle('A5:E'.$i)->applyFromArray($styleArray);

$filename = "Report_Data_Pembelian.xlsx";
$writer = new Xlsx($spreadsheet);
$writer->save($filename);
$content = file_get_contents($filename);
header("Content-Disposition: attachment; filename=".$filename);
unlink($filename);
exit($content);
?>
