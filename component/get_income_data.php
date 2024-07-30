<?php
include '../konekdb/config.php';

$query = "SELECT DATE_FORMAT(ic_date, '%b') AS month, SUM(ic_total) AS total_income 
          FROM income_db 
          GROUP BY MONTH(ic_date)";
$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
