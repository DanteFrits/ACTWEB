<?php
include "konekdb/koneksi.php";

require 'vendor/autoload.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Ambil informasi pengguna dari session
$username = $_SESSION['username'];

// Lakukan pengecekan untuk menentukan akses pengguna
$is_admin = false; // Misalnya, beri nilai default false
if ($username === 'admin') {
    $is_admin = true;
}

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$inputFileName = 'templetes/salarytalent.xlsx';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load($inputFileName);

// $activeWorksheet = $spreadsheet->getActiveSheet();

// $no = 1;
// $ambildata = mysqli_query($koneksi, "SELECT * FROM income_db INNER JOIN talent_db ON income_db.ic_talent = talent_db.tl_kode ORDER BY ic_date DESC, ic_id ASC");
// $tampil = mysqli_fetch_array($ambildata)
// while ($tampil) {
//   $spreadsheet->getActiveSheet()->setCellValue("A" . $no, $tampil['ic_date']);
//   $spreadsheet->getActiveSheet()->setCellValue("B" . $no, $tampil['tl_alias']);
//   $spreadsheet->getActiveSheet()->setCellValue("C" . $no, $tampil['tl_manager']);

//   $no++;
// }

$sql=mysqli_query($koneksi,"select * from income_db INNER JOIN talent_db ON income_db.ic_talent = talent_db.tl_kode where ic_id ='$_GET[kode]'");
$tampil=mysqli_fetch_array($sql);

$potonganact = ($tampil['ic_total'] * 30) / 100;
$potonganmanager = ($tampil['ic_total'] * 5) / 100;
$total_potongan = ($tampil['ic_total'] * 35) / 100;
$salary = ($tampil['ic_total'] - $total_potongan);

$spreadsheet->getActiveSheet()->setCellValue("C7" , $tampil['ic_date']);
$spreadsheet->getActiveSheet()->setCellValue("C4" , $tampil['tl_alias']);
$spreadsheet->getActiveSheet()->setCellValue("C5" , $tampil['tl_nama']);
$spreadsheet->getActiveSheet()->setCellValue("F7" , $tampil['tl_kode']);
$spreadsheet->getActiveSheet()->setCellValue("C11" , $tampil['ic_saweria']);
$spreadsheet->getActiveSheet()->setCellValue("C12" , $tampil['ic_trakteer']);
$spreadsheet->getActiveSheet()->setCellValue("C13" , $tampil['ic_socialbuzz']);
$spreadsheet->getActiveSheet()->setCellValue("C14" , $tampil['ic_yt']);
$spreadsheet->getActiveSheet()->setCellValue("C15" , $tampil['ic_tiktok']);
$spreadsheet->getActiveSheet()->setCellValue("C18" , $tampil['ic_total']);
$spreadsheet->getActiveSheet()->setCellValue("H10" , $potonganact);
$spreadsheet->getActiveSheet()->setCellValue("H14" , $potonganmanager);
$spreadsheet->getActiveSheet()->setCellValue("H18" , $total_potongan);
$spreadsheet->getActiveSheet()->setCellValue("D21" , $salary);

$outputFileName = 'excel/Salary' . '-' . $tampil['ic_date'] . '-' . $tampil['tl_alias']  . '.xlsx';

$writer = new Xlsx($spreadsheet);
$writer->save($outputFileName);

header("Location: pages/incomes.php");

?>
