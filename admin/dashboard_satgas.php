<?php
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
include 'includes/db.php';
include 'includes/auth_satgas.php';
try {
    $query = $conn->prepare("SELECT * FROM laporan WHERE status = 'Belum Dikerjakan' ORDER BY tanggal_peristiwa DESC");
    $query->execute();
    $laporan = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Terjadi kesalahan saat mengakses database: " . $e->getMessage();
}

if (isset($_GET['action']) && $_GET['action'] === 'kerjakan' && isset($_GET['id'])) {
    $laporanId = $_GET['id'];
    $userId = $_SESSION['user_id'];

    try {
        $updateQuery = $conn->prepare("UPDATE laporan SET status = 'Sedang Dikerjakan' WHERE id = :id AND status = 'Belum Dikerjakan'");
        $updateQuery->execute(['id' => $laporanId]);

        $logQuery = $conn->prepare("INSERT INTO satgas_logs (id_satgas, id_laporan, tanggal_ambil) VALUES (:id_satgas, :id_laporan, NOW())");
        $logQuery->execute(['id_satgas' => $userId, 'id_laporan' => $laporanId]);

        header("Location: dashboard_satgas.php");
        exit();
    } catch (PDOException $e) {
        $error = "Terjadi kesalahan saat memproses laporan: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Satgas</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'includes/sidebar_satgas.php'; ?>
    <div class="main-content">
        <h1>Dashboard Satgas</h1>

        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>

        <h2>Laporan Belum Dikerjakan</h2>
        <table class="report-table">
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
                    foreach ($laporan as $report) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($report['kode_laporan']); ?></td>
                            <td><?php echo htmlspecialchars($report['nama_pelapor']); ?></td>
                            <td><?php echo htmlspecialchars($report['status']); ?></td>
                            <td><?php echo htmlspecialchars($report['tanggal_peristiwa']); ?></td>
                            <td>
                                <a href="dashboard_satgas.php?action=kerjakan&id=<?php echo $report['id']; ?>">Kerjakan</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="5">Tidak ada laporan dengan status 'Belum Dikerjakan'.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
