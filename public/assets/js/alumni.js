document.addEventListener('DOMContentLoaded', () => {
    const { pendidikan, pekerjaan, tahunKelulusan } = window.alumniData;

    // Pie Chart - Pendidikan
    new Chart(document.getElementById('pendidikanChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: pendidikan.map(item => item.jenjang_pendidikan_terakhir ?? 'Tidak Diisi'),
            datasets: [{
                data: pendidikan.map(item => item.total),
                backgroundColor: ['#A8DADC', '#FBC4AB', '#FFE066', '#B5EAD7', '#FFDAC1']
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Bar Chart - Pekerjaan
    new Chart(document.getElementById('pekerjaanChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: pekerjaan.map(item => item.pekerjaan_saat_ini ?? 'Tidak Diisi'),
            datasets: [{
                label: 'Jumlah Alumni',
                data: pekerjaan.map(item => item.total),
                backgroundColor: '#FBC4AB',
                borderRadius: { topLeft: 6, topRight: 6 }
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false }, ticks: { color: '#444' } }
            }
        }
    });

    // Line Chart - Tahun Kelulusan
    new Chart(document.getElementById('kelulusanChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: tahunKelulusan.map(item => item.tahun_kelulusan),
            datasets: [{
                label: 'Jumlah Alumni',
                data: tahunKelulusan.map(item => item.total),
                borderColor: '#457B9D',
                backgroundColor: 'rgba(69,123,157,0.1)',
                tension: 0.4,
                pointRadius: 3
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
});
