<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php'; 

if ($_SESSION['role'] === 'admin') {
    include 'includes/sidebar.php';
} elseif ($_SESSION['role'] === 'satgas') {
    include 'includes/sidebar_satgas.php';
}

try {
    $sql = "
        SELECT 
            laporan.id AS id_laporan,
            laporan.kode_laporan,
            laporan.nama_pelapor,
            laporan.status,
            laporan.tanggal_peristiwa,
            users.nama_lengkap AS penanggung_jawab
        FROM laporan
        LEFT JOIN satgas_logs ON laporan.id = satgas_logs.id_laporan
        LEFT JOIN users ON satgas_logs.id_satgas = users.id
        WHERE laporan.status = 'Selesai'
        ORDER BY laporan.tanggal_peristiwa DESC;
    ";
    $query = $conn->prepare($sql);
    $query->execute();
    $laporan = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Terjadi kesalahan saat mengakses database: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Laporan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="main-content">
        <h1>Arsip Laporan</h1>

        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>

        <h2>Laporan Selesai</h2>
        <table class="report-table">
            <thead>
                <tr>
                    <th>Kode Laporan</th>
                    <th>Nama Pelapor</th>
                    <th>Status</th>
                    <th>Tanggal Peristiwa</th>
                    <th>Penanggung Jawab</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($laporan) > 0) {
                    foreach ($laporan as $report) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($report['kode_laporan']); ?></td>
                            <td><?php echo htmlspecialchars($report['nama_pelapor']); ?></td>
                            <td><?php echo htmlspecialchars($report['status']); ?></td>
                            <td><?php echo htmlspecialchars($report['tanggal_peristiwa']); ?></td>
                            <td><?php echo htmlspecialchars($report['penanggung_jawab'] ?? 'Tidak Ditugaskan'); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="5">Tidak ada laporan selesai tersedia.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
