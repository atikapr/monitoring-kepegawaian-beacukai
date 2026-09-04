@extends('layouts.app')

@section('title', '- Laporan')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.css">
<style>
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        margin-bottom: 1rem;
    }
    .gender-icon {
        width: 24px;
        height: 24px;
        margin: 2px;
    }
    .legend-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 4px 8px;
        background: white;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
    }
    .chart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    .chart-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .download-btn {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .download-btn:hover {
        background: #f3f4f6;
    }
</style>
@endpush

@section('content')
<main class="mt-[100px]">
    <div class="container-fluid px-6 py-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Laporan Visualisasi Data Pegawai</h2>
    </div>

    <div id="statisticsDashboard">
        <div class="mb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="statisticsDashboard">
        <!-- Total Pegawai -->
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pegawai</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $data['statistik']['total_pegawai'] }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-gray-500">Total keseluruhan pegawai</span>
            </div>
        </div>

        <!-- Rata-rata Usia -->
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Rata-rata Usia</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $data['statistik']['rata_rata_usia'] }} <span class="text-base font-normal text-gray-600">tahun</span></p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="flex justify-between mt-2">
                <span class="text-xs text-gray-500">Usia termuda: {{ $data['statistik']['usia_termuda'] }} tahun</span>
                <span class="text-xs text-gray-500">Usia tertua: {{ $data['statistik']['usia_tertua'] }} tahun</span>
            </div>
        </div>

        <!-- Distribusi Gender -->
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Distribusi Gender</p>
                    <div class="flex gap-4 mt-1">
                        <p class="text-2xl font-bold text-gray-900">
                            <span class="text-blue-600">{{ $data['statistik']['total_laki_laki'] }}</span>
                            <span class="text-base font-normal text-gray-600">L</span>
                        </p>
                        <p class="text-2xl font-bold text-gray-900">
                            <span class="text-pink-600">{{ $data['statistik']['total_perempuan'] }}</span>
                            <span class="text-base font-normal text-gray-600">P</span>
                        </p>
                    </div>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-xs text-gray-500">Total pegawai berdasarkan gender</span>
            </div>
        </div>
    </div>
</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Jenis Kelamin -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="text-lg font-semibold text-gray-800">Distribusi Jenis Kelamin</h3>
                <button onclick="downloadChart('jenisKelaminChart')" class="download-btn">
                    <i class="fas fa-download text-blue-600"></i>
                </button>
            </div>
            <div id="genderVisual" class="mb-4"></div>
            <div class="chart-container">
                <canvas id="jenisKelaminChart"></canvas>
            </div>
            <div class="legend-container"></div>
        </div>

        <!-- Pendidikan -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="text-lg font-semibold text-gray-800">Distribusi Pendidikan Terakhir</h3>
                <button onclick="downloadChart('pendidikanChart')" class="download-btn">
                    <i class="fas fa-download text-blue-600"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="pendidikanChart"></canvas>
            </div>
            <div class="legend-container"></div>
        </div>

        <!-- Seksi -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="text-lg font-semibold text-gray-800">Distribusi per Seksi</h3>
                <button onclick="downloadChart('seksiChart')" class="download-btn">
                    <i class="fas fa-download text-blue-600"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="seksiChart"></canvas>
            </div>
            <div class="legend-container"></div>
        </div>

        <!-- Usia -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="text-lg font-semibold text-gray-800">Distribusi Usia</h3>
                <button onclick="downloadChart('usiaChart')" class="download-btn">
                    <i class="fas fa-download text-blue-600"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="usiaChart"></canvas>
            </div>
            <div class="legend-container"></div>
        </div>

        <!-- Status Pegawai -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="text-lg font-semibold text-gray-800">Distribusi Status Pegawai</h3>
                <button onclick="downloadChart('statusPegawaiChart')" class="download-btn">
                    <i class="fas fa-download text-blue-600"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="statusPegawaiChart"></canvas>
            </div>
            <div class="legend-container"></div>
        </div>

        <!-- Lama Penugasan -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="text-lg font-semibold text-gray-800">Distribusi Lama Penugasan di Lhoksheumawe</h3>
                <button onclick="downloadChart('lamaPenugasanChart')" class="download-btn">
                    <i class="fas fa-download text-blue-600"></i>
                </button>
            </div>
            <div class="chart-container">
                <canvas id="lamaPenugasanChart"></canvas>
            </div>
            <div class="legend-container"></div>
        </div>

        <div class="chart-card" style="min-height: 500px">
    <div class="chart-header">
        <h3 class="text-lg font-semibold text-gray-800">Distribusi Lama Penempatan di Seksi Terakhir</h3>
        <button onclick="downloadChart('lamaPenempatanChart')" class="download-btn">
            <i class="fas fa-download text-blue-600"></i>
        </button>
    </div>
    <div class="chart-container">
        <canvas id="lamaPenempatanChart"></canvas>
    </div>
    <div class="legend-container"></div>
</div>
    </div>
</div>
</main>
@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script>

    
// Modern color palette with distinct colors
const CHART_COLORS = {
    gender: ['#1E90FF', '#FF69B4'],
    education: ['#3498db', '#9b59b6', '#1abc9c', '#f1c40f', '#e67e22', '#e74c3c'],
    section: ['#16a085', '#c0392b', '#2980b9', '#8e44ad', '#27ae60'],
    age: ['#2ecc71', '#e74c3c', '#3498db', '#f39c12', '#9b59b6'],
    status: ['#27ae60', '#8e44ad', '#c0392b', '#16a085', '#3498db'],
    assignment: ['#34495e', '#9b59b6', '#2980b9', '#f1c40f', '#16a085'],
    placement: ['#2980b9', '#8e44ad', '#c0392b', '#27ae60', '#f39c12']
};

// Update konfigurasi chart untuk skala yang lebih longgar
const chartConfigs = {
    bar: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const value = Math.round(context.raw); // Bulatkan angka
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((value / total) * 100); // Bulatkan persentase
                        return `${value} orang (${percentage}%)`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Jumlah (orang)',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                },
                grid: {
                    display: true
                },
                ticks: {
                    padding: 10,
                    stepSize: 1, // Gunakan step 1 untuk bilangan bulat
                    callback: function(value) {
                        return Math.round(value); // Bulatkan angka di axis
                    }
                },
                afterDataLimits: (scale) => {
                    // Tambahkan 30% padding ke nilai maksimum
                    const maxValue = scale.max;
                    scale.max = Math.ceil(maxValue * 1.3);
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    padding: 10
                }
            }
        },
        layout: {
            padding: {
                left: 20,
                right: 30,
                top: 20,
                bottom: 20
            }
        }
    },
    pie: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    font: {
                        size: 12
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const value = context.raw;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        return `${context.label}: ${value} orang (${percentage}%)`;
                    }
                }
            }
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 40
            }
        }
    }
};

function createGenderVisual(data) {
    const container = document.getElementById('genderVisual');
    container.innerHTML = '';
    
    const visualContainer = document.createElement('div');
    visualContainer.className = 'flex justify-around items-center p-4 bg-gray-50 rounded-lg';
    
    // Toilet-style modern icons
    const maleIcon = `
        <svg class="w-12 h-12" viewBox="0 0 24 24">
            <g fill="${CHART_COLORS.gender[0]}">
                <!-- Head -->
                <circle cx="12" cy="5" r="3"/>
                <!-- Body with legs apart -->
                <path d="M12 8L12 14M12 14L9 20M12 14L15 20M7 10L17 10" 
                      fill="none" 
                      stroke="${CHART_COLORS.gender[0]}" 
                      stroke-width="2" 
                      stroke-linecap="round"/>
            </g>
        </svg>`;
        
    const femaleIcon = `
        <svg class="w-12 h-12" viewBox="0 0 24 24">
            <g fill="${CHART_COLORS.gender[1]}">
                <!-- Head -->
                <circle cx="12" cy="5" r="3"/>
                <!-- Dress/Triangle body -->
                <path d="M7 10L12 8L17 10L14 20L10 20L7 10Z" 
                      stroke="${CHART_COLORS.gender[1]}" 
                      stroke-width="2" 
                      stroke-linejoin="round"/>
            </g>
        </svg>`;

    // Alternative version with more classic toilet sign style
    const maleIcon2 = `
        <svg class="w-12 h-12" viewBox="0 0 24 24">
            <g fill="${CHART_COLORS.gender[0]}">
                <!-- Head -->
                <circle cx="12" cy="4" r="2.5"/>
                <!-- Body - stick figure style -->
                <rect x="11" y="6" width="2" height="7"/>
                <!-- Arms -->
                <rect x="8" y="8" width="8" height="2"/>
                <!-- Legs -->
                <path d="M11 13L9 20M13 13L15 20" 
                      stroke="${CHART_COLORS.gender[0]}" 
                      stroke-width="2" 
                      stroke-linecap="round"/>
            </g>
        </svg>`;
        
    const femaleIcon2 = `
        <svg class="w-12 h-12" viewBox="0 0 24 24">
            <g fill="${CHART_COLORS.gender[1]}">
                <!-- Head -->
                <circle cx="12" cy="4" r="2.5"/>
                <!-- Dress - simple triangle -->
                <path d="M12 6L17 16H7L12 6Z"/>
                <!-- Legs -->
                <path d="M10 16L10 20M14 16L14 20" 
                      stroke="${CHART_COLORS.gender[1]}" 
                      stroke-width="2" 
                      stroke-linecap="round"/>
            </g>
        </svg>`;
    
    data.forEach(item => {
        const genderDiv = document.createElement('div');
        genderDiv.className = 'flex flex-col items-center';
        
        const iconContainer = document.createElement('div');
        iconContainer.className = 'mb-3';
        // Gunakan maleIcon2 dan femaleIcon2 untuk versi klasik toilet sign
        iconContainer.innerHTML = item.label === 'Laki-laki' ? maleIcon2 : femaleIcon2;
        
        const label = document.createElement('div');
        label.className = 'text-center';
        label.innerHTML = `
            <div class="font-semibold">${item.label}</div>
            <div class="text-sm text-gray-600">${item.formatted_value} orang</div>
            <div class="text-xs text-gray-500">(${item.percentage}%)</div>
        `;
        
        genderDiv.appendChild(iconContainer);
        genderDiv.appendChild(label);
        visualContainer.appendChild(genderDiv);
    });
    
    container.appendChild(visualContainer);
}

// Add statistics dashboard
function createStatisticsDashboard(data) {
    const container = document.getElementById('statisticsDashboard');
    if (!container) return;
    
    container.className = 'grid grid-cols-1 md:grid-cols-3 gap-4 mb-6';
    container.innerHTML = `
        <div class="bg-white rounded-lg shadow p-4">
            <h4 class="text-lg font-semibold mb-2">Total Pegawai</h4>
            <p class="text-3xl font-bold text-blue-600">${data.total_pegawai}</p>
            <div class="mt-2 text-sm text-gray-600">orang</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h4 class="text-lg font-semibold mb-2">Rata-rata Usia</h4>
            <p class="text-3xl font-bold text-green-600">${data.rata_rata_usia}</p>
            <div class="mt-2 text-sm text-gray-600">tahun</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h4 class="text-lg font-semibold mb-2">Rentang Usia</h4>
            <p class="text-3xl font-bold text-purple-600">${data.usia_termuda} - ${data.usia_tertua}</p>
            <div class="mt-2 text-sm text-gray-600">tahun</div>
        </div>
    `;
}

// Fungsi untuk membuat chart dengan nilai bulat
function createChart(elementId, data, type, colors) {
    const canvas = document.getElementById(elementId);
    const ctx = canvas.getContext('2d');
    
    // Set canvas size untuk kualitas lebih baik
    const dpr = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width * dpr;
    canvas.height = rect.height * dpr;
    ctx.scale(dpr, dpr);
    
    // Bulatkan semua nilai data
    const roundedData = data.map(item => ({
        ...item,
        value: Math.round(item.value),
        percentage: Math.round(parseFloat(item.percentage))
    }));
    
    const config = {
        type: type,
        data: {
            labels: roundedData.map(item => item.label),
            datasets: [{
                data: roundedData.map(item => item.value),
                backgroundColor: colors,
                borderColor: colors,
                borderWidth: 1
            }]
        },
        options: type === 'pie' ? chartConfigs.pie : chartConfigs.bar
    };
    
    // Update legend dengan nilai bulat
    const legendContainer = canvas.closest('.chart-card').querySelector('.legend-container');
    legendContainer.innerHTML = '';
    
    const total = roundedData.reduce((sum, item) => sum + item.value, 0);
    roundedData.forEach((item, index) => {
        const legendItem = document.createElement('div');
        legendItem.className = 'legend-item';
        legendItem.innerHTML = `
            <span class="legend-color" style="background-color: ${colors[index]}"></span>
            <span class="text-sm">${item.label}: ${item.value} (${Math.round(item.percentage)}%)</span>
        `;
        legendContainer.appendChild(legendItem);
    });
    
    return new Chart(ctx, config);
}

function downloadChart(chartId) {
    const canvas = document.getElementById(chartId);
    const chartCard = canvas.closest('.chart-card');
    const title = chartCard.querySelector('h3').textContent;
    const legendContainer = chartCard.querySelector('.legend-container');
    const chart = Chart.getChart(chartId);
    

    // Set canvas dimensions and scaling
    const chartWidth = canvas.offsetWidth;
    const chartHeight = canvas.offsetHeight;
    const padding = 40;
    const scaleFactor = 4; // Higher resolution
    
    // Calculate legend dimensions
    const legendItemHeight = 25;
    const legendPadding = 20;
    const legendItems = legendContainer ? legendContainer.querySelectorAll('.legend-item') : [];
    const legendHeight = legendItems.length * legendItemHeight + legendPadding;

    // Create temporary canvas with proper dimensions
    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = (chartWidth + padding * 2) * scaleFactor;
    tempCanvas.height = (chartHeight + legendHeight + padding * 2) * scaleFactor;

    const tempCtx = tempCanvas.getContext('2d');
    tempCtx.scale(scaleFactor, scaleFactor);

    // Fill background
    tempCtx.fillStyle = '#ffffff';
    tempCtx.fillRect(0, 0, tempCanvas.width / scaleFactor, tempCanvas.height / scaleFactor);

    // Draw title
    tempCtx.font = 'bold 20px Arial';
    tempCtx.fillStyle = '#000000';
    tempCtx.textAlign = 'center';
    tempCtx.fillText(title, tempCanvas.width / (2 * scaleFactor), padding);
    tempCtx.textAlign = 'left';

    // Draw chart
    tempCtx.drawImage(canvas, padding, padding + 20, chartWidth, chartHeight);

   // Draw legend with improved layout and matching colors
if (legendItems.length > 0) {
    const legendStartY = chartHeight + padding + 30;
    const colorBoxSize = 16;
    const textPadding = 10;
    
    legendItems.forEach((item, index) => {
        const yPosition = legendStartY + (index * legendItemHeight);
        const label = item.textContent.trim();
        const color = item.style.backgroundColor;

        // Draw color box with slight rounding
        tempCtx.beginPath();
        tempCtx.roundRect(padding, yPosition, colorBoxSize, colorBoxSize, 2);
        tempCtx.fillStyle = color; // Gunakan warna yang sama dengan chart
        tempCtx.fill();

        // Draw legend text dengan warna yang sama dengan chart
        tempCtx.font = '14px Arial';
        tempCtx.fillStyle = color; // Gunakan warna yang sama dengan chart
        tempCtx.fillText(label, padding + colorBoxSize + textPadding, yPosition + colorBoxSize - 2);
    });
}

    // Add border to the entire chart
    tempCtx.strokeStyle = '#e0e0e0';
    tempCtx.lineWidth = 1;
    tempCtx.strokeRect(padding / 2, padding / 2, 
        tempCanvas.width / scaleFactor - padding, 
        tempCanvas.height / scaleFactor - padding);

    // Download the canvas as an image
    const link = document.createElement('a');
    link.download = `${title.toLowerCase().replace(/\s+/g, '-')}.png`;
    link.href = tempCanvas.toDataURL('image/png', 1.0);
    link.click();
}


// Download all charts as PDF
async function downloadAllCharts() {
    try {
        const response = await fetch('/laporan/download-pdf');
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'laporan-kepegawaian.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);
    } catch (error) {
        console.error('Error downloading PDF:', error);
        alert('Terjadi kesalahan saat mengunduh PDF. Silakan coba lagi.');
    }
}

// Initialize all charts
document.addEventListener('DOMContentLoaded', function() {
    const data = @json($data);
    
    // Create statistics dashboard
    if (data.statistik) {
        createStatisticsDashboard(data.statistik);
    }
    
    // Initialize all charts
    if (data.jenisKelamin?.length) {
        createGenderVisual(data.jenisKelamin);
        createChart('jenisKelaminChart', data.jenisKelamin, 'pie', CHART_COLORS.gender);
    }
    
    if (data.pendidikan?.length) {
        createChart('pendidikanChart', data.pendidikan, 'bar', CHART_COLORS.education);
    }
    
    if (data.seksi?.length) {
        createChart('seksiChart', data.seksi, 'bar', CHART_COLORS.section);
    }
    
    if (data.usia?.length) {
        createChart('usiaChart', data.usia, 'bar', CHART_COLORS.age);
    }
    
    if (data.statusPegawai?.length) {
        createChart('statusPegawaiChart', data.statusPegawai, 'pie', CHART_COLORS.status);
    }
    
    if (data.lamaPenugasan?.length) {
        createChart('lamaPenugasanChart', data.lamaPenugasan, 'bar', CHART_COLORS.assignment);
    }
    
    if (data.lamaPenempatan?.length) {
        const penempatanContainer = document.getElementById('lamaPenempatanChart').closest('.chart-card');
        penempatanContainer.style.minHeight = '500px'; // Tinggi minimum yang lebih besar
        
        createChart('lamaPenempatanChart', data.lamaPenempatan, 'bar', CHART_COLORS.placement);
    }
});
</script>
@endpush