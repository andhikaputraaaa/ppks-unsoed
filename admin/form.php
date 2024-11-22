<?php
// Menghubungkan ke database
include 'includes/db.php';

// Proses ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_pelapor = $_POST['nama_pelapor'];
    $jenis_identitas = $_POST['jenis_identitas'];
    $nomor_identitas = $_POST['nomor_identitas'];
    $unit_kerja = $_POST['unit_kerja'];
    $kategori = $_POST['kategori'];
    $alamat = $_POST['alamat'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $email = $_POST['email'];
    $status_terlapor = $_POST['status_terlapor'];
    $nama_terlapor = $_POST['nama_terlapor'];
    $nomor_telepon_terlapor = $_POST['nomor_telepon_terlapor'];
    $tanggal_peristiwa = $_POST['tanggal_peristiwa'];
    $lokasi_peristiwa = $_POST['lokasi_peristiwa'];
    $kronologi_peristiwa = $_POST['kronologi_peristiwa'];

    // Generate kode laporan secara acak
    $kode_laporan = strtoupper(uniqid('LAP-', true));

    try {
        // Query untuk memasukkan data laporan ke dalam database
        $stmt = $conn->prepare("INSERT INTO laporan (nama_pelapor, jenis_identitas, nomor_identitas, unit_kerja, kategori, alamat, nomor_telepon, email, status_terlapor, nama_terlapor, nomor_telepon_terlapor, tanggal_peristiwa, lokasi_peristiwa, kronologi_peristiwa, kode_laporan, tanggal_laporan) 
        VALUES (:nama_pelapor, :jenis_identitas, :nomor_identitas, :unit_kerja, :kategori, :alamat, :nomor_telepon, :email, :status_terlapor, :nama_terlapor, :nomor_telepon_terlapor, :tanggal_peristiwa, :lokasi_peristiwa, :kronologi_peristiwa, :kode_laporan, NOW())");

        // Bind parameter
        $stmt->bindParam(':nama_pelapor', $nama_pelapor);
        $stmt->bindParam(':jenis_identitas', $jenis_identitas);
        $stmt->bindParam(':nomor_identitas', $nomor_identitas);
        $stmt->bindParam(':unit_kerja', $unit_kerja);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status_terlapor', $status_terlapor);
        $stmt->bindParam(':nama_terlapor', $nama_terlapor);
        $stmt->bindParam(':nomor_telepon_terlapor', $nomor_telepon_terlapor);
        $stmt->bindParam(':tanggal_peristiwa', $tanggal_peristiwa);
        $stmt->bindParam(':lokasi_peristiwa', $lokasi_peristiwa);
        $stmt->bindParam(':kronologi_peristiwa', $kronologi_peristiwa);
        $stmt->bindParam(':kode_laporan', $kode_laporan);

        // Eksekusi query
        $stmt->execute();

        // Redirect setelah data berhasil disimpan
        header("Location: success.php");
        exit();
    } catch (PDOException $e) {
        // Menangani error jika terjadi masalah dalam eksekusi query
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Laporan</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <h2>Form Laporan</h2>
    <form method="POST" action="form.php">
        <label for="nama_pelapor">Nama Pelapor:</label>
        <input type="text" name="nama_pelapor" id="nama_pelapor" required />

        <label for="jenis_identitas">Jenis Identitas:</label>
        <input type="text" name="jenis_identitas" id="jenis_identitas" required />

        <label for="nomor_identitas">Nomor Identitas:</label>
        <input type="text" name="nomor_identitas" id="nomor_identitas" required />

        <label for="unit_kerja">Unit Kerja:</label>
        <input type="text" name="unit_kerja" id="unit_kerja" required />

        <label for="kategori">Kategori:</label>
        <input type="text" name="kategori" id="kategori" required />

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required></textarea>

        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" required />

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required />

        <label for="status_terlapor">Status Terlapor:</label>
        <input type="text" name="status_terlapor" id="status_terlapor" required />

        <label for="nama_terlapor">Nama Terlapor:</label>
        <input type="text" name="nama_terlapor" id="nama_terlapor" required />

        <label for="nomor_telepon_terlapor">Nomor Telepon Terlapor:</label>
        <input type="text" name="nomor_telepon_terlapor" id="nomor_telepon_terlapor" required />

        <label for="tanggal_peristiwa">Tanggal Peristiwa:</label>
        <input type="date" name="tanggal_peristiwa" id="tanggal_peristiwa" required />

        <label for="lokasi_peristiwa">Lokasi Peristiwa:</label>
        <input type="text" name="lokasi_peristiwa" id="lokasi_peristiwa" required />

        <label for="kronologi_peristiwa">Kronologi Peristiwa:</label>
        <textarea name="kronologi_peristiwa" id="kronologi_peristiwa" required></textarea>

        <button type="submit">Kirim Laporan</button>
    </form>
</body>
</html>
