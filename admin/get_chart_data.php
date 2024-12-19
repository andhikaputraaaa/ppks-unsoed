<?php
// Menangani error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi
include 'includes/db.php';

try {
    // Check if the connection is successful
    if ($conn) {
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
    } else {
        throw new PDOException("Database connection failed");
    }
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
