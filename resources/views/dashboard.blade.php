<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan - Warung Cireng Munu'u</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: #dc3545 !important; }
        .page-header {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }
        .info-box {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            border-left: 4px solid;
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .info-box.info-box-success { border-left-color: #28a745; }
        .info-box.info-box-primary { border-left-color: #0dcaf0; }
        .info-box.info-box-warning { border-left-color: #ffc107; }
        .info-box.info-box-danger { border-left-color: #dc3545; }
        .info-box-icon {
            font-size: 2.5rem;
            margin-right: 1rem;
            width: 80px;
            text-align: center;
        }
        .info-box-content {
            flex: 1;
        }
        .info-box-text {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .info-box-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
        }
        .chart-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        .chart-section h4 {
            color: #333;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chart-tabs {
            display: flex;
            gap: 0.5rem;
            font-size: 0.85rem;
        }
        .chart-tabs button {
            background: #f0f0f0;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        .chart-tabs button.active {
            background: #dc3545;
            color: white;
        }
        .product-list {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }
        .product-list h5 {
            color: #333;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .product-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .product-number {
            color: #666;
            font-weight: 500;
        }
        .table-orders {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        .table-orders h5 {
            color: #333;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .table-orders table {
            font-size: 0.85rem;
        }
        .badge-success { background-color: #28a745 !important; }
        .badge-warning { background-color: #ffc107 !important; color: #333 !important; }
        .badge-danger { background-color: #dc3545 !important; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🍴 Cireng Munu'u - Admin</a>
            <div class="ms-auto">
                <a href="{{ route('menu') }}" class="btn btn-outline-light btn-sm me-2">Lihat Menu</a>
                <a href="/" class="btn btn-outline-light btn-sm me-2">Home</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">🚪 Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container-fluid">
            <h4 class="mb-0 fw-bold">📊 Dashboard Penjualan</h4>
        </div>
    </div>

    <div class="container-fluid">
        <!-- STAT CARDS -->
        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <div class="info-box info-box-success">
                    <div class="info-box-icon">💰</div>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Revenue</span>
                        <span class="info-box-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="info-box info-box-primary">
                    <div class="info-box-icon">📦</div>
                    <div class="info-box-content">
                        <span class="info-box-text">Produk Terjual</span>
                        <span class="info-box-number">{{ $totalProdukTerjual ?? 0 }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="info-box info-box-warning">
                    <div class="info-box-icon">🛒</div>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pesanan</span>
                        <span class="info-box-number">{{ $totalOrders ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="row">
            <div class="col-md-8">
                <!-- GRAFIK PENJUALAN -->
                <div class="chart-section">
                    <h4>
                        📈 Grafik Penjualan
                        <div class="chart-tabs">
                            <button class="active" onclick="switchChart('bulan')">Bulan Ini</button>
                            <button onclick="switchChart('tahun')">Tahun Ini</button>
                        </div>
                    </h4>
                    <canvas id="salesChart" height="80"></canvas>
                </div>
            </div>

            <div class="col-md-4">
                <!-- PRODUK FAVORIS -->
                <div class="product-list">
                    <h5>🌟 Produk Favoris</h5>
                    <div class="product-item">
                        <span>1. Cireng Pedas - Cireng Original</span>
                    </div>
                    <div class="product-item">
                        <span>2. Cireng Keju</span>
                    </div>
                    <div class="product-item">
                        <span>3. Cireng Kaju</span>
                    </div>
                </div>

                <!-- RIWAYAT ORDER TERBARU -->
                <div class="table-orders">
                    <h5>⏰ Riwayat Order Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->nama_pelanggan }}</td>
                                        <td>{{ $order->nama_produk }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada pesanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR PESANAN -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="table-orders">
                    <h5>📋 Daftar Pesanan Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>{{ $order->nama_pelanggan }}</td>
                                        <td>{{ $order->nama_produk }}</td>
                                        <td><span class="badge bg-info">{{ $order->quantity }}x</span></td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td><small>{{ $order->created_at->format('d/m/Y H:i') }}</small></td>
                                        <td>
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesanan ini?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            <p>📭 Belum ada pesanan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="bg-dark text-white py-3 mt-5 text-center">
        <div class="container-fluid">
            <p class="mb-0">&copy; 2024 Warung Cireng Munu'u - Dashboard</p>
            <p class="text-secondary mt-1">Renyah & Gurih! 🔥</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentChart = null;

        function initChart() {
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            
            currentChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [
                        {
                            label: 'Penjualan (Rp)',
                            data: [2500, 3200, 4500, 3800, 4200, 5500, 6200, 5800, 7500, 6800, 5900, 6500],
                            borderColor: '#28a745',
                            backgroundColor: 'rgba(40, 167, 69, 0.08)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 5,
                            pointBackgroundColor: '#28a745',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 7
                        },
                        {
                            label: 'Bulan Ini',
                            data: [3000, 3500, 4800, 4200, 4500, 5800, 6500, 6100, 7800, 7100, 6200, 6800],
                            borderColor: '#dc3545',
                            backgroundColor: 'rgba(220, 53, 69, 0.08)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 5,
                            pointBackgroundColor: '#dc3545',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 7,
                            borderDash: [5, 5]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                usePointStyle: true,
                                font: { size: 11, weight: '600' },
                                padding: 15
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                                },
                                font: { size: 10 }
                            },
                            grid: {
                                color: 'rgba(200, 200, 200, 0.1)',
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        }

        function switchChart(type) {
            // Update button active state
            document.querySelectorAll('.chart-tabs button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Destroy existing chart
            if (currentChart) {
                currentChart.destroy();
            }
            
            // Reinitialize
            initChart();
        }

        // Initialize chart on page load
        initChart();
    </script>
</body>
</html>
