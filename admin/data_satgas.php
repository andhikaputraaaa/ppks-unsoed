<?php
include 'includes/db.php';
include 'includes/auth_admin.php';

$sql = "SELECT id, nama_lengkap, umur, email, alamat 
        FROM users 
        WHERE role = 'satgas'";
$query = $conn->prepare($sql);
$query->execute();
$satgasData = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Satgas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-content">
        <h1>Data Satgas</h1>
        <?php if (count($satgasData) > 0) { ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID Satgas</th>
                        <th>Nama Lengkap</th>
                        <th>Umur</th>
                        <th>Email</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($satgasData as $satgas) { ?>
                        <tr>
                            <td><?= htmlspecialchars($satgas['id']) ?></td>
                            <td><?= htmlspecialchars($satgas['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($satgas['umur']) ?></td>
                            <td><?= htmlspecialchars($satgas['email']) ?></td>
                            <td><?= htmlspecialchars($satgas['alamat']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="error-message">Belum ada data Satgas yang terdaftar.</p>
        <?php } ?>
    </div>
</body>
</html>
