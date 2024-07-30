<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'konekdb/config.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $username;

        // Simpan session ID di database
        $session_id = session_id();
        $user_id = $row['id'];
        $sql_insert_session = "INSERT INTO userlogin (user_id, session_id) VALUES ('$user_id', '$session_id')";
        $conn->query($sql_insert_session);

        header("Location: pages/dashboard.php");
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }
    $conn->close();
}
?>
