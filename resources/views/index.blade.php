<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Warung Cireng Munu'u</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { background-color: #dc3545 !important; }
        .card-cireng {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-cireng:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .price {
            font-size: 1.5rem;
            color: #dc3545;
            font-weight: 700;
        }
        .btn-action {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
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
        .form-group label {
            font-weight: 600;
            color: #333;
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
        .alert-success { background-color: #d4edda; border-color: #c3e6cb; }
        .alert-error { background-color: #f8d7da; border-color: #f5c6cb; }
        .btn-edit {
            background-color: #ffc107;
            color: #333;
            font-weight: 600;
        }
        .btn-edit:hover {
            background-color: #e0a800;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            font-weight: 600;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('menu') }}">🍴 Cireng Munu'u - Admin</a>
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
        <div class="container">
            <h1 class="display-5 fw-bold">Admin Dashboard</h1>
            <p class="lead">Kelola menu cireng dengan mudah</p>
        </div>
    </div>

    <div class="container">

        <!-- FORM TAMBAH MENU -->
        <div class="form-section">
            <h3>➕ Tambah Menu Baru</h3>
            <form action="{{ route('pembeli.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Contoh: Cireng Isi Ayam" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="12000" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="link_wa" class="form-label">Link WhatsApp</label>
                        <input type="url" class="form-control" id="link_wa" name="link_wa" placeholder="https://wa.me/62123456789" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="link_img" class="form-label">Link Gambar</label>
                        <input type="url" class="form-control" id="link_img" name="link_img" placeholder="https://example.com/image.jpg" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi menu cireng..." required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-submit btn-danger">💾 Simpan Menu</button>
            </form>
        </div>

        <!-- DAFTAR MENU -->
        <div>
            <h2 class="fw-bold mb-4">📋 Daftar Menu Cireng</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                @forelse($cirengs as $c)
                    <div class="col-md-4 mb-4">
                        <div class="card card-cireng h-100">
                            <img src="{{ $c->link_img ?? 'https://via.placeholder.com/300x200?text=Cireng' }}" class="card-img-top" alt="{{ $c->nama_menu }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $c->nama_menu }}</h5>
                                <p class="card-text text-muted">{{ $c->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                <div class="price">Rp {{ number_format($c->harga, 0, ',', '.') }}</div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2 mt-auto">
                                    <a href="{{ $c->link_wa }}" target="_blank" class="btn btn-success flex-grow-1 btn-action">
                                        💬 WhatsApp
                                    </a>
                                    <button type="button" class="btn btn-edit btn-action" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $c->id }}">
                                        ✏️ Edit
                                    </button>
                                    <form action="{{ route('cireng.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-action">🗑️</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="editModal{{ $c->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">✏️ Edit Menu: {{ $c->nama_menu }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('cireng.update', $c->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_nama_{{ $c->id }}" class="form-label">Nama Menu</label>
                                            <input type="text" class="form-control" id="edit_nama_{{ $c->id }}" name="nama_menu" value="{{ $c->nama_menu }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_harga_{{ $c->id }}" class="form-label">Harga (Rp)</label>
                                            <input type="number" class="form-control" id="edit_harga_{{ $c->id }}" name="harga" value="{{ $c->harga }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_link_wa_{{ $c->id }}" class="form-label">Link WhatsApp</label>
                                            <input type="url" class="form-control" id="edit_link_wa_{{ $c->id }}" name="link_wa" value="{{ $c->link_wa }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_link_img_{{ $c->id }}" class="form-label">Link Gambar</label>
                                            <input type="url" class="form-control" id="edit_link_img_{{ $c->id }}" name="link_img" value="{{ $c->link_img }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_deskripsi_{{ $c->id }}" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="edit_deskripsi_{{ $c->id }}" name="deskripsi" rows="4" required>{{ $c->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">💾 Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            <h5>📭 Belum Ada Menu</h5>
                            <p>Silakan tambahkan menu cireng melalui form di atas!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <footer class="bg-dark text-white py-4 mt-5 text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Warung Cireng Munu'u - Admin Dashboard</p>
            <p class="text-secondary mt-2">Renyah & Gurih! 🔥</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>