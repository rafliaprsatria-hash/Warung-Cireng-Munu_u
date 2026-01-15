<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Warung Cireng Munu'u</title>
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
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .card-text {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        .price {
            font-size: 1.8rem;
            color: #dc3545;
            font-weight: 700;
            margin: 1rem 0;
        }
        .btn-pesan {
            background-color: #dc3545;
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .btn-pesan:hover {
            background-color: #c82333;
            color: white;
        }
        .page-header {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 3rem;
            text-align: center;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ccc;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('menu') }}">🍴 Cireng Munu'u</a>
            <div class="ms-auto">
                <a href="/" class="btn btn-outline-light btn-sm me-2">Kembali Home</a>
                <a href="{{ route('cireng.index') }}" class="btn btn-outline-light btn-sm">Admin Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1 class="display-4 fw-bold">Menu Pilihan Kami</h1>
            <p class="lead">Cireng Isi Renyah dengan Bumbu Rahasia yang Bikin Nagih!</p>
        </div>
    </div>

    <section class="py-5">
        <div class="container">
            <div class="row">
                @if($cirengs->isNotEmpty())
                    @foreach($cirengs as $c)
                        <div class="col-md-4 mb-4">
                            <div class="card card-cireng h-100">
                                <!-- Gambar -->
                                <img src="{{ $c->link_img ?? 'https://via.placeholder.com/400x250?text=Cireng' }}" class="card-img-top" alt="{{ $c->nama_menu }}">

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $c->nama_menu }}</h5>

                                    <!-- Deskripsi -->
                                    <p class="card-text">
                                        {{ $c->deskripsi ?? 'Cireng pilihan kami dengan cita rasa yang luar biasa nikmat. Dibuat dengan bahan berkualitas tinggi dan bumbu rahasia yang rahasia!' }}
                                    </p>

                                    <!-- Harga -->
                                    <div class="price">Rp {{ number_format($c->harga, 0, ',', '.') }}</div>

                                    <!-- Tombol Pesan -->
                                    <button type="button" class="btn btn-pesan btn-danger w-100 mt-auto" data-bs-toggle="modal" data-bs-target="#pesanModal{{ $c->id }}">
                                        🛒 Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL PESAN -->
                        <div class="modal fade" id="pesanModal{{ $c->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">💬 Pesan {{ $c->nama_menu }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="pesan_{{ $c->id }}" class="form-label">Pesan Anda:</label>
                                            <textarea class="form-control" id="pesan_{{ $c->id }}" rows="4" placeholder="Tuliskan pesan Anda...">Halo, saya ingin memesan {{ $c->nama_menu }} seharga Rp {{ number_format($c->harga, 0, ',', '.') }}</textarea>
                                        </div>
                                        <div class="alert alert-info small">
                                            <strong>📝 Tips:</strong> Customize pesan sesuai kebutuhan Anda sebelum mengirim
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-success" onclick="pesanWhatsApp('{{ $c->link_wa }}', document.getElementById('pesan_{{ $c->id }}').value)">
                                            💬 Kirim ke WhatsApp
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- DEMO CARDS -->
                    <div class="col-md-4 mb-4">
                        <div class="card card-cireng h-100">
                            <img src="https://via.placeholder.com/400x250?text=Cireng+Isi+Ayam" class="card-img-top" alt="Cireng Isi Ayam">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Cireng Isi Ayam</h5>
                                <p class="card-text">Cireng gurih dengan isian daging ayam kampung yang empuk dan lezat. Dilengkapi dengan bumbu rahasia yang membuat setiap gigitan terasa nikmat.</p>
                                
                                
                                <div class="price">Rp 12.000</div>
                                <button class="btn btn-pesan btn-danger w-100 mt-auto">🛒 Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card card-cireng h-100">
                            <img src="https://www.shutterstock.com/image-photo/cireng-snack-originating-sundanese-region-600nw-2401932053.jpg" class="card-img-top" alt="Cireng Isi Udang">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Cireng Isi Udang</h5>
                                <p class="card-text">Cireng premium dengan isian udang segar yang melimpah. Tekstur renyah di luar, isi yang juicy di dalam. Sempurna untuk cemilan atau makanan pembuka.</p>
                                
                                
                                <div class="price">Rp 15.000</div>
                                <button class="btn btn-pesan btn-danger w-100 mt-auto">🛒 Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card card-cireng h-100">
                            <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/250/2025/01/15/unnamed-4-2125970847.png" class="card-img-top" alt="Cireng Isi Keju">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Cireng Isi Keju</h5>
                                <p class="card-text">Cireng special dengan isian keju mozzarella yang meleleh ketika digigit. Kombinasi unik antara gurih dan creamy yang akan membuat Anda ketagihan.</p>
                                <div class="price">Rp 13.000</div>
                                <button class="btn btn-pesan btn-danger w-100 mt-auto">🛒 Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-5 text-center">
        <div class="container">
            <p class="mb-0">&copy; 2024 Warung Cireng Munu'u - Pemrograman 1 Tugas Besar</p>
            <p class="text-secondary mt-2">Renyah & Gurih! 🔥</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function pesanWhatsApp(whatsappLink, pesan) {
            // Extract phone number dari WhatsApp link
            const phoneNumber = whatsappLink.replace('https://wa.me/', '').split('?')[0];
            
            // Encode pesan
            const encodedPesan = encodeURIComponent(pesan);
            
            // Buat URL WhatsApp dengan pesan
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedPesan}`;
            
            // Buka di tab baru
            window.open(whatsappUrl, '_blank');
        }
    </script>
</body>
</html>
