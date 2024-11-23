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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Satgas PPKS Unsoed</title>
        <link rel="shortcut icon" href="aset/Logo_Unsoed.png" />
        <link rel="stylesheet" href="css/style-lapor.css" />
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar">
            <div class="navbar-logo">
                <a href="beranda.html"
                    ><img src="aset/Logo_Unsoed.png" alt="" height="40px"></a>
                <a href="beranda.html">PPKS <span>UNSOED</span></a>
            </div>
            <div class="navbar-nav">
                <a href="beranda.html">Beranda</a>
                <a href="">Profil</a>
                <a href="lapor.html" class="nav-lapor">Lapor</a>
                <a href="">Tracking Aduan</a>
            </div>
        </nav>
        <!-- hero section -->
        <div class="hero">
            <div class="petunjuk">
                <h1>ADUAN ONLINE</h1>
                <a href=""><button>Petunjuk Pelaporan</button></a>
            </div>
            <div class="form">
                <div class="logo-form">
                    <img src="aset/pelapor.png" width="40" height="40">
                    <h2>Pelapor</h2>
                </div>
                <div class="kirikanan">
                    <div class="form-kiri">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Nama Lengkap</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="gap" name="nama_pelapor"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Identitas</td>
                                </tr>
                                <tr>
                                    <td><select class="gap" name="jenis_identitas">
                                        <option value="ktp">Kartu Tanda Penduduk (KTP)</option>
                                        <option value="ktm">Kartu Tanda Mahasiswa (KTM)</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Nomor Identitas</td>
                                </tr>
                                <tr>
                                    <td><input type="number" class="gap" name="nomor_identitas"></td>
                                </tr>
                                <tr>
                                    <td>Nama Unit Kerja/Fakultas/Instansi</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="gap" name="unit_kerja"></td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                </tr>
                                <tr>
                                    <td><select class="gap" name="kategori">
                                        <option value="korban">Korban</option>
                                        <option value="pelapor">Pelapor/Saksi</option>
                                    </select></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="form-kanan">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Alamat</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="gap" name="alamat"></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                </tr>
                                <tr>
                                    <td><input type="number" class="gap" name="nomor_telepon"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                </tr>
                                <tr>
                                    <td><input type="email" class="gap" name="email"></td>
                                </tr>
                                <tr>
                                    <td>Status Pelapor</td>
                                </tr>
                                <tr>
                                    <td><select class="gap" name="status_pelapor">
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="tenaga">Tenaga Kependidikan</option>
                                        <option value="masyarakat">Masyarakat Umum</option>
                                    </select></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="logo-form">
                    <img src="aset/terlapor.png" width="40" height="40">
                    <h2>Terlapor</h2>
                </div>
                <div class="kirikanan">
                    <div class="form-kiri">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Nama Lengkap Terlapor</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="gap" name="nama_terlapor"></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon Terlapor</td>
                                </tr>
                                <tr>
                                    <td><input type="number" class="gap" name="nomor_telepon_terlapor"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="form-kanan">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Status Terlapor</td>
                                </tr>
                                <tr>
                                    <td><select class="gap" name="status_terlapor">
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="tenaga">Tenaga Kependidikan</option>
                                        <option value="masyarakat">Masyarakat Umum</option>
                                    </select></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="logo-form">
                    <img src="aset/peristiwa.png" width="40" height="40">
                    <h2>Peristiwa</h2>
                </div>
                <div class="kirikanan">
                    <div class="form-kiri">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Tanggal Peristiwa</td>
                                </tr>
                                <tr>
                                    <td><input type="date" class="gap" name="tanggal_peristiwa"></td>
                                </tr>
                                <tr>
                                    <td>Lokasi Peristiwa</td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="gap" name="lokasi_peristiwa"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="form-kanan">
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Kronologi Peristiwa</td>
                                </tr>
                                <tr>
                                    <td><textarea class="gap" name="lokasi_peristiwa"></textarea></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit">
            </div>
        </div>
    </body>
</html>
