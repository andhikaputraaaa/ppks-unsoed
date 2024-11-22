<?php
session_start();
include 'includes/db.php';
include 'includes/auth_satgas.php';

$id = $_GET['id'];

$sql = "SELECT * FROM laporan WHERE id = :id";
$query = $conn->prepare($sql);
$query->execute(['id' => $id]);
$row = $query->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Laporan tidak ditemukan.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_sql = "UPDATE laporan SET status = 'Selesai' WHERE id = :id";
    $update_query = $conn->prepare($update_sql);
    $update_query->execute(['id' => $id]);

    if ($update_query->rowCount() > 0) {
        header("Location: dashboard_admin.php");
        exit;
    } else {
        echo "Gagal mengubah status.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-content">
        <h2>Detail Laporan</h2>
        <p><strong>Nama Pelapor:</strong> <?= htmlspecialchars($row['nama_pelapor']) ?></p>
        <p><strong>Jenis Identitas:</strong> <?= htmlspecialchars($row['jenis_identitas']) ?></p>
        <p><strong>Nomor Identitas:</strong> <?= htmlspecialchars($row['nomor_identitas']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
        <p><strong>Tanggal Peristiwa:</strong> <?= htmlspecialchars($row['tanggal_peristiwa']) ?></p>
        <p><strong>Lokasi Peristiwa:</strong> <?= htmlspecialchars($row['lokasi_peristiwa']) ?></p>
        <p><strong>Kronologi:</strong> <?= htmlspecialchars($row['kronologi_peristiwa']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>

        <?php if ($row['status'] !== 'Selesai'): ?>
        <form method="POST">
            <button type="submit">Selesai</button>
        </form>
        <?php else: ?>
        <p>Status laporan sudah selesai.</p>
        <?php endif; ?>
    </div>
</body>
</html>
