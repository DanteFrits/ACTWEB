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

$inputFileName = 'templetes/rekapsalary.xlsx';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load($inputFileName);

$bulan = $_GET['bulan'];
$nama_bulan = date("F", strtotime("2024-$bulan-01"));

$activeWorksheet = $spreadsheet->getActiveSheet();

$no = 7;
// $ambildata = mysqli_query($koneksi, "SELECT * FROM income_db INNER JOIN talent_db ON income_db.ic_talent = talent_db.tl_kode ORDER BY ic_date DESC, ic_id ASC");
$ambildata = mysqli_query($koneksi, "SELECT * FROM income_db 
                    INNER JOIN talent_db ON income_db.ic_talent = talent_db.tl_kode 
                    WHERE MONTH(ic_date) = '$bulan' AND YEAR(ic_date) = '2024'");


while ($tampil = mysqli_fetch_array($ambildata)) {
  $spreadsheet->getActiveSheet()->setCellValue("A" . $no, $tampil['ic_date']);
  $spreadsheet->getActiveSheet()->setCellValue("B" . $no, $tampil['tl_kode']);
  $spreadsheet->getActiveSheet()->setCellValue("D" . $no, $tampil['tl_alias']);
  $spreadsheet->getActiveSheet()->setCellValue("E" . $no, $tampil['ic_saweria']);
  $spreadsheet->getActiveSheet()->setCellValue("G" . $no, $tampil['ic_trakteer']);
  $spreadsheet->getActiveSheet()->setCellValue("H" . $no, $tampil['ic_socialbuzz']);
  $spreadsheet->getActiveSheet()->setCellValue("I" . $no, $tampil['ic_yt']);
  $spreadsheet->getActiveSheet()->setCellValue("J" . $no, $tampil['ic_tiktok']);

  $no++;
}

$spreadsheet->getActiveSheet()->setCellValue("C4", "" . $nama_bulan . ' 2024');

$outputFileName = 'excel/Rekap Salary' . '-' . $nama_bulan . '-' . '2024' . '.xlsx';

$writer = new Xlsx($spreadsheet);
$writer->save($outputFileName);

header("Location: pages/incomes.php");

?>