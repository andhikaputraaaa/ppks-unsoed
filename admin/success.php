<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Berhasil</title>
    <link rel="shortcut icon" href="../aset/Logo_Unsoed.png">
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
            <h2>Kode Laporan Anda</h2>
            <p id="ticket-display">Kode Laporan: <span id="ticket-code">#LOADING </span><button id="copy-button" class="copy-btn">Salin</button></p>
            
            <p>Silakan simpan kode tiket ini untuk keperluan pelacakan laporan Anda.</p>
        </div>
        <div class="button-container">
            <a href="../beranda.html" class="btn">Kembali ke Beranda</a>
            <a href="inputTracking.php" class="btn">Lacak Laporan</a>
        </div>
    </div>

    <script>
        // Ambil kode laporan dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const kodeLaporan = urlParams.get('kode_laporan');

        if (kodeLaporan) {
            localStorage.setItem('ticketCode', kodeLaporan);
            document.getElementById('ticket-code').innerHTML = kodeLaporan ;
        }

        // Copy Kode 
        document.getElementById('copy-button').addEventListener('click', function() {
            const ticketCode = document.getElementById('ticket-code').textContent.trim();
            navigator.clipboard.writeText(ticketCode).then(function() {
                alert('Kode tiket berhasil disalin ke clipboard!');
            }).catch(function(err) {
                console.error('Gagal menyalin teks: ', err);
                alert('Gagal menyalin kode tiket.');
            });
        });
    </script>
</body>
</html>
