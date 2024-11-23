// Fungsi untuk memformat nama bulan
function getMonthName(monthNumber) {
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthNumber - 1];
}

document.addEventListener('DOMContentLoaded', function() {
    // Array of all month labels
    const allMonths = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'October', 'November', 'Desember'
    ];

    // Fetch chart data
    fetch('admin/get_chart_data.php')
        .then(response => response.json())
        .then(data => {
            // Initialize the data array with zeros
            const jumlahAduan = new Array(12).fill(0);

            // Map the fetched data to the corresponding month labels
            data.forEach(item => {
                const monthIndex = new Date(item.bulan).getMonth();
                jumlahAduan[monthIndex] = item.jumlah_aduan;
            });

            // Create chart
            const ctx = document.getElementById('chartAduan').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allMonths,
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
                                color: '#000',
                                font: {
                                    size: 14,
                                    weight: 'normal'
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#000',
                                font: {
                                    size: 14,
                                    weight: 'normal'
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#000',
                                font: {
                                    size: 16,
                                    weight: 'normal'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#000',
                            borderWidth: 1
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching chart data:', error));

    // Fetch total aduan and aduan selesai
    fetch('admin/get_total_aduan.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-aduan').textContent = data.total_aduan;
            document.getElementById('aduan-selesai').textContent = data.aduan_selesai;
        })
        .catch(error => console.error('Error fetching totals:', error));
});