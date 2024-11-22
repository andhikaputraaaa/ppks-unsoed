<div class="sidebar">
    <?php isset($_SESSION['username']) ?>
    <ul>
        <li class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></li>
        <li><a href="dashboard_satgas.php">Beranda</a></li>
        <li><a href="arsip_laporan.php">Arsip Laporan</a></li>
        <li><a href="laporan_saya.php">Laporan Saya</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
