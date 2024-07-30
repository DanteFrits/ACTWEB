<?php
session_start();
include '../konekdb/config.php';

// Hapus session ID dari database
$user_id = $_SESSION['user_id'];
$sql_delete_session = "DELETE FROM userlogin WHERE user_id='$user_id'";
$conn->query($sql_delete_session);

// Hapus semua variabel session
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login
header("Location: ../index.php");
exit();
?>
