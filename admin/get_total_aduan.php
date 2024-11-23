<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppks_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total number of reports
$sql_total = "SELECT COUNT(*) as total FROM laporan";
$result_total = $conn->query($sql_total);
$total_aduan = $result_total->fetch_assoc()['total'];

// Fetch number of completed reports
$sql_completed = "SELECT COUNT(*) as completed FROM laporan WHERE status = 'Selesai'";
$result_completed = $conn->query($sql_completed);
$aduan_selesai = $result_completed->fetch_assoc()['completed'];

$conn->close();

echo json_encode([
    'total_aduan' => $total_aduan,
    'aduan_selesai' => $aduan_selesai
]);
?>