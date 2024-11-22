<?php
session_start();
include 'includes/db.php';
include 'includes/auth_satgas.php';

try {
    $queryLaporan = $conn->prepare("
        SELECT laporan.* 
        FROM laporan
        JOIN satgas_logs ON laporan.id = satgas_logs.id_laporan
        WHERE satgas_logs.id_satgas = :id_satgas 
        AND laporan.status = 'Sedang Dikerjakan'
    ");
    $queryLaporan->execute(['id_satgas' => $_SESSION['user_id']]);
    $laporan = $queryLaporan->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Terjadi kesalahan saat mengakses database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Saya</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'includes/sidebar_satgas.php'; ?>
    
    <div class="main-content">
        <h2>Laporan Saya</h2>
        <table border="1" class="report-table">
            <thead>
                <tr>
                    <th>Kode Laporan</th>
                    <th>Nama Pelapor</th>
                    <th>Status</th>
                    <th>Tanggal Peristiwa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($laporan) > 0) {
                    foreach ($laporan as $row) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kode_laporan']); ?></td>
                            <td><?= htmlspecialchars($row['nama_pelapor']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_peristiwa']); ?></td>
                            <td>
                                <a href="detail_laporan_satgas.php?id=<?= htmlspecialchars($row['id']); ?>">Detail</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="5">Tidak ada laporan yang sedang dikerjakan.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
