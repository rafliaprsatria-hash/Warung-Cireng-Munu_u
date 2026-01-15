<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Warung Cireng Munu'u</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: #dc3545 !important; }
        .page-header {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .form-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .form-section h3 {
            color: #333;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #dc3545;
            padding-bottom: 0.5rem;
        }
        .btn-submit {
            background-color: #dc3545;
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
        }
        .btn-submit:hover {
            background-color: #c82333;
        }
        .orders-table {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .orders-table h3 {
            color: #333;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #dc3545;
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🍴 Cireng Munu'u - Admin</a>
            <div class="ms-auto">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm me-2">📊 Dashboard</a>
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
        <div class="container">
            <h1 class="display-5 fw-bold">📝 Kelola Pesanan</h1>
            <p class="lead">Atur dan pantau semua pesanan pelanggan</p>
        </div>
    </div>

    <div class="container">

        <!-- FORM TAMBAH PESANAN -->
        <div class="form-section">
            <h3>➕ Tambah Pesanan Baru</h3>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cireng_id" class="form-label">Pilih Menu</label>
                        <select class="form-control" id="cireng_id" name="cireng_id" required>
                            <option value="">-- Pilih Menu --</option>
                            @foreach($cirengs as $cireng)
                                <option value="{{ $cireng->id }}">{{ $cireng->nama_menu }} (Rp {{ number_format($cireng->harga, 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Jumlah (Quantity)</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="5" min="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nomor_wa" class="form-label">Nomor WhatsApp (Opsional)</label>
                        <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" placeholder="62123456789">
                    </div>
                </div>
                <button type="submit" class="btn btn-submit btn-danger">💾 Tambah Pesanan</button>
            </form>
        </div>

        <!-- DAFTAR PESANAN -->
        <div class="orders-table">
            <h3>📋 Daftar Pesanan</h3>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-danger">
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
                                <td><strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
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

    <footer class="bg-dark text-white py-4 mt-5 text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Warung Cireng Munu'u - Kelola Pesanan</p>
            <p class="text-secondary mt-2">Renyah & Gurih! 🔥</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
