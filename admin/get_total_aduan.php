<?php
include 'includes/db.php';

try {
    // Check if the connection is successful
    if ($conn) {
        // Fetch total number of reports
        $sql_total = "SELECT COUNT(*) as total FROM laporan";
        $stmt_total = $conn->prepare($sql_total);
        $stmt_total->execute();
        $total_aduan = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];

        // Fetch number of completed reports
        $sql_completed = "SELECT COUNT(*) as completed FROM laporan WHERE status = 'Selesai'";
        $stmt_completed = $conn->prepare($sql_completed);
        $stmt_completed->execute();
        $aduan_selesai = $stmt_completed->fetch(PDO::FETCH_ASSOC)['completed'];

        echo json_encode([
            'total_aduan' => $total_aduan,
            'aduan_selesai' => $aduan_selesai
        ]);
    } else {
        throw new PDOException("Database connection failed");
    }
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>