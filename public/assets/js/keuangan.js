document.addEventListener('DOMContentLoaded', function () {
    const pemasukan = window.financeData?.pemasukan || [];
    const pengeluaran = window.financeData?.pengeluaran || [];

    const bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const dataPemasukan = Array(12).fill(0);
    const dataPengeluaran = Array(12).fill(0);

    pemasukan.forEach(item => dataPemasukan[item.bulan - 1] = item.total);
    pengeluaran.forEach(item => dataPengeluaran[item.bulan - 1] = item.total);

    const ctx = document.getElementById('financeChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Pemasukan',
                backgroundColor: '#5D87FF',
                borderRadius: { topLeft: 5, topRight: 5 },
                data: dataPemasukan
            }, {
                label: 'Pengeluaran',
                backgroundColor: '#FA896B',
                borderRadius: { topLeft: 5, topRight: 5 },
                data: dataPengeluaran
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#444',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    titleFont: { size: 12 },
                    bodyFont: { size: 12 }
                }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { color: '#666', font: { size: 11 } }
                },
                y: {
                    beginAtZero: true,
                    grid: { display: false, drawBorder: false },
                    ticks: { display: false }
                }
            },
            layout: {
                padding: { top: 10, bottom: 0 }
            }
        }
    });
});
