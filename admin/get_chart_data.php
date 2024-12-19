<?php
// Menangani error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ppks_db';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT MONTH(tanggal_laporan) AS bulan, COUNT(*) AS jumlah_aduan 
            FROM laporan 
            GROUP BY bulan
            ORDER BY bulan";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
