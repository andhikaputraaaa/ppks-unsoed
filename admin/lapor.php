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
    $status_pelapor = $_POST['status_pelapor'];
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
        $stmt = $conn->prepare("INSERT INTO laporan (nama_pelapor, jenis_identitas, nomor_identitas, unit_kerja, kategori, alamat, nomor_telepon, email, status_pelapor, status_terlapor, nama_terlapor, nomor_telepon_terlapor, tanggal_peristiwa, lokasi_peristiwa, kronologi_peristiwa, kode_laporan, tanggal_laporan) 
        VALUES (:nama_pelapor, :jenis_identitas, :nomor_identitas, :unit_kerja, :kategori, :alamat, :nomor_telepon, :email, :status_pelapor, :status_terlapor, :nama_terlapor, :nomor_telepon_terlapor, :tanggal_peristiwa, :lokasi_peristiwa, :kronologi_peristiwa, :kode_laporan, NOW())");

        // Bind parameter
        $stmt->bindParam(':nama_pelapor', $nama_pelapor);
        $stmt->bindParam(':jenis_identitas', $jenis_identitas);
        $stmt->bindParam(':nomor_identitas', $nomor_identitas);
        $stmt->bindParam(':unit_kerja', $unit_kerja);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':nomor_telepon', $nomor_telepon);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status_pelapor', $status_pelapor);
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