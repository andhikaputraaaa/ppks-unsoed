<?php
include 'includes/db.php';

if (isset($_POST['submit'])) {
    $kodeLapor = $_POST['kodetrack'];
    
    $sqlquery = $conn->prepare("SELECT * FROM laporan WHERE kode_laporan = :kode");
    $sqlquery->bindParam(':kode', $kodeLapor, PDO::PARAM_STR);
    $sqlquery->execute();
    
    if ($sqlquery->rowCount() > 0) {
        $data = $sqlquery->fetch(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION['data'] = $data;
        header('Location:Tracking.php');
        exit();
    } else {
        $err = "<font color='red'>Kode yang anda masukkan tidak tersedia</font >";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../aset/Logo_Unsoed.png">
    <link rel="stylesheet" href="../css/InputTracking.css">
    <title>Tracking Aduan</title>
</head>
<body>
    
    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="../beranda.html"><img src="../aset/Logo_Unsoed.png" alt="" height="40px"></a>
            <a href="../beranda.html">PPKS <span>UNSOED</span></a>
        </div>
        <div class="navbar-nav">
            <a href="../beranda.html">Beranda</a>
            <a href="../profil.html">Profil</a>
            <a href="../lapor.html" class="nav-lapor">Lapor</a>
            <a href="inputTracking.php">Tracking Aduan</a>
        </div>
    </nav>
    <div class="batasNav"></div>
    
    <!-- input kode -->
    <div class="track">
        <div class="judul">
            <h1>Tracking Aduan</h1>
            <p>Lihat perkembangan laporan anda</p>
        </div>
        <div class="krem">
            <div class="contain">
                <p>Silahkan masukkan kode aduan yang anda dapatkan ketika melakukan pelaporan. Kode ini juga dikirimkan ke email anda setelah anda selesai melakukan pelaporan</p>
                <div class="masuk">
                    <form method="POST" action="inputTracking.php">
                        <input type="text" name="kodetrack" placeholder="Masukkan Kode Aduan Anda">
                        <input type="submit" name="submit">
                        <?php if(isset($err)) echo $err; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <p>© 2024 Satgas PPKS Unsoed. All Rights Reserved.</p>
    </footer>
</body>
</html>