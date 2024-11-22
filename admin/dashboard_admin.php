    <?php
    ini_set('session.gc_maxlifetime', 3600);
    session_set_cookie_params(3600);
    session_start();
    include 'includes/auth_admin.php';
    include 'includes/db.php';
    try {
        $query = $conn->query("SELECT * FROM laporan ORDER BY tanggal_peristiwa DESC");
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
        <title>Dashboard Admin</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <?php include 'includes/sidebar.php'; ?>
        <div class="main-content">
            <h1>Dashboard Admin</h1>

            <?php if (isset($error)) { ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>

            <h2>Daftar Laporan</h2>
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
                                <td><a href="detail_laporan.php?id=<?php echo $report['id']; ?>">Lihat Detail</a></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr><td colspan="5">Tidak ada laporan tersedia.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
