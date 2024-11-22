<?php
session_start();
include 'includes/db.php';
include 'includes/auth_admin.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'satgas')) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM laporan WHERE id = :id";
$query = $conn->prepare($sql);
$query->execute(['id' => $id]);
$row = $query->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Laporan tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_baru = $_POST['status'];

    $update_sql = "UPDATE laporan SET status = :status WHERE id = :id";
    $update_query = $conn->prepare($update_sql);
    $update_query->execute([
        'status' => $status_baru,
        'id' => $id
    ]);

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

        <form method="POST">
            <label for="status">Ubah Status:</label>
            <select name="status" id="status">
                <option value="Belum Dikerjakan" <?= $row['status'] === 'Belum Dikerjakan' ? 'selected' : '' ?>>Belum Dikerjakan</option>
                <option value="Sedang Dikerjakan" <?= $row['status'] === 'Sedang Dikerjakan' ? 'selected' : '' ?>>Sedang Dikerjakan</option>
                <option value="Selesai" <?= $row['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
