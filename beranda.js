// Fungsi untuk memformat nama bulan
function getMonthName(monthNumber) {
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthNumber - 1];
}

document.addEventListener('DOMContentLoaded', function() {
// Ambil data dari PHP
fetch('admin/get_chart_data.php')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => getMonthName(item.bulan));
        const jumlahAduan = data.map(item => item.jumlah_aduan);

        // Buat chart
        const ctx = document.getElementById('chartAduan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Aduan',
                    data: jumlahAduan,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#000', // Color of the y-axis labels
                            font: {
                                size: 14, // Size of the y-axis labels
                                weight: 'normal' // Weight of the y-axis labels
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)' // Color of the y-axis grid lines
                        }
                    },
                    x: {
                        ticks: {
                            color: '#000', // Color of the x-axis labels
                            font: {
                                size: 14, // Size of the x-axis labels
                                weight: 'normal' // Weight of the x-axis labels
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)' // Color of the x-axis grid lines
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#000', // Color of the legend labels
                            font: {
                                size: 16, // Size of the legend labels
                                weight: 'normal ' // Weight of the legend labels
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)', // Background color of the tooltip
                        titleColor: '#fff', // Color of the tooltip title
                        bodyColor: '#fff', // Color of the tooltip body
                        borderColor: '#000', // Border color of the tooltip
                        borderWidth: 1 // Border width of the tooltip
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching chart data:', error));

    fetch('admin/get_total_aduan.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('total-aduan').textContent = data.total_aduan;
        document.getElementById('aduan-selesai').textContent = data.aduan_selesai;
    })
    .catch(error => console.error('Error fetching totals:', error));
});