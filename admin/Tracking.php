<?php
include 'includes/db.php';

session_start();
if (!isset($_SESSION['data'])) {
    header('Location:inputTracking.php');
    exit();
}

$data = $_SESSION['data'];
unset($_SESSION['data']);

$m = "";
$mpar = ""; 
$isAct1 = false;
$isAct2 = false;
if ($data['status'] == "Belum Dikerjakan") {
    $m = "Laporan Anda Telah Kami Terima";
    $mpar = "Laporan anda telah kami konfirmasi dan akan segera kami proses lebih lanjut lagi.";
} elseif ($data['status'] == "Sedang Dikerjakan") {
    $m = "Laporan Anda Dalam Proses Penanganan Kami";
    $mpar = "Laporan anda sedang dalam proses penanganan kami, mohon bersabar menunggu sampai kabar selanjutnya mengenai laporan anda. Proses ini melibatkan investigasi mendalam terkait peristiwa yang terjadi.";
    $isAct1 = true;
} else {
    $m = "Laporan Anda Telah Selesai!";
    $mpar = "Kasus dari laporan yang telah anda berikan telah tuntas melewati investigasi kami, anda bisa mengecek e-mail anda mengenai detail kasus terkait.";
    $isAct1 = true;
    $isAct2 = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../aset/Logo_Unsoed.png">
    <link rel="stylesheet" href="../css/Tracking.css">
    <title>Tracking Aduan</title>
</head>
<body>

    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="../index.html"><img src="../aset/Logo_Unsoed.png" alt="" height="40px"></a>
            <a href="../index.html">PPKS <span>UNSOED</span></a>
        </div>
        <div class="navbar-nav">
            <a href="../index.html">Beranda</a>
            <a href="../profil.html">Profil</a>
            <a href="../lapor.html" class="nav-lapor">Lapor</a>
            <a href="inputTracking.php">Tracking Aduan</a>
        </div>
    </nav>

    <div class="batasNav"></div>
    
    <!-- detail -->
    <div class="deskrip">
        <div class="laporan">
            <div class="krem">
                <div class="detail">
                    <div class="ket">
                        <img src="../aset/pelapor-ashBlue.png">
                        <h1>Pelapor</h1>
                    </div>
                    <p><?= htmlspecialchars($data['nama_pelapor']); ?></p>
                </div>
                <div class="detail">
                    <div class="ket">
                        <img src="../aset/terlapor-ashBlue.png">
                        <h1>Terlapor</h1>
                    </div>
                    <p><?= htmlspecialchars($data['nama_terlapor']); ?></p>
                </div>
                <div class="detail">
                    <div class="ket">
                        <img src="../aset/peristiwa-ashBlue.png">
                        <h1>Peristiwa</h1>
                    </div>
                    <p><?= htmlspecialchars($data['lokasi_peristiwa']); ?>,<br><?= htmlspecialchars($data['tanggal_peristiwa']); ?></p>
                </div>
            </div>
        </div>
        <div class="hasil">
            <h1><?= $m; ?></h1>
            <p><?= $mpar; ?></p>
        </div>
    </div>

    <!-- track -->
    <div class="trackingBar">
        <div class="progres">
            <div class="bullet active"></div>
            <p class="aktif">Laporan Diterima</p>
        </div>
        <div class="bar-left <?= $isAct1 ? 'active' : 'inactive'; ?>"></div>
        <div class="progres">
            <div class="bullet <?= $isAct1 ? 'active' : 'inactive'; ?>"></div>
            <p class="<?= $isAct1 ? 'aktif' : 'inaktif'; ?>">Laporan Diproses</p>
        </div>
        <div class="bar-right <?= $isAct2 ? 'active' : 'inactive'; ?>"></div>
        <div class="progres">
            <div class="bullet <?= $isAct2 ? 'active' : 'inactive'; ?>"></div>
            <p class="<?= $isAct2 ? 'aktif' : 'inaktif'; ?>">Laporan Selesai</p>
        </div>
    </div>
    
    <footer>
        <p>© 2024 Satgas PPKS Unsoed. All Rights Reserved.</p>
    </footer>
</body>
</html>