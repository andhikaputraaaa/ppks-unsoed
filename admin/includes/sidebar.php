<div class="sidebar">
    <ul>
    <?php isset($_SESSION['username']) ?>
    <li class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></li>
        <li><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="arsip_laporan.php">Arsip Laporan</a></li>
        <li><a href="data_satgas.php">Data Satgas</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
