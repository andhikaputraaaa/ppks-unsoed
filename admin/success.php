<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Berhasil</title>
    <link rel="stylesheet" href="assets/style-succes.css">
</head>
<body>
    <div class="success-container">
        <div class="success-message">
            <h1>Terima Kasih!</h1>
            <p>
                Laporan Anda telah berhasil kami terima. Tim Satgas PPKS akan segera memproses laporan Anda.
                Ingatlah, Anda tidak sendiri. Kami di sini untuk mendukung dan membantu Anda.
            </p>
        </div>
        <div class="ticket-info">
            <h2>Tiket Laporan Anda</h2>
            <p id="ticket-display">Kode Tiket: <span id="ticket-code">#LOADING</span></p>
            <p>Silakan simpan kode tiket ini untuk keperluan pelacakan laporan Anda.</p>
        </div>
        <div class="button-container">
            <a href="../beranda.html" class="btn">Kembali ke Beranda</a>
            <a href="../tracking.html" class="btn">Lacak Laporan</a>
        </div>
    </div>

    <script>
        // Ambil kode laporan dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const kodeLaporan = urlParams.get('kode_laporan');

        if (kodeLaporan) {
            // Simpan kode laporan ke local storage
            localStorage.setItem('ticketCode', kodeLaporan);

            // Tampilkan kode laporan di halaman
            document.getElementById('ticket-code').textContent = kodeLaporan;
        } else {
            // Jika tidak ada kode laporan di URL
            document.getElementById('ticket-display').textContent = 'Kode Tiket: Tidak ditemukan.';
        }
    </script>
</body>
</html>
