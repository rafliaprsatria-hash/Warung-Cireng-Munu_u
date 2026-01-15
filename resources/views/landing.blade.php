<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Cireng Munu'u - Renyah & Gurih!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1541544537156-7627a7a4aa1c?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .card-cireng { transition: transform 0.3s; border: none; border-radius: 15px; overflow: hidden; }
        .card-cireng:hover { transform: translateY(-10px); }
        .btn-pesan { background-color: #dc3545; border: none; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Cireng Munu'u</a>
            <div class="ms-auto">
                <a href="{{ route('cireng.index') }}" class="btn btn-outline-light btn-sm">Admin Dashboard</a>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1 class="display-3 fw-bold">Warung Cireng Munu'u</h1>
            <p class="lead">Sensasi Cireng Isi Paling Renyah dan Bumbu Rahasia yang Bikin Nagih!</p>
            <a href="{{ route('menu') }}" class="btn btn-warning btn-lg fw-bold mt-3">Lihat Menu</a>
        </div>
    </header>

    <section id="menu" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Pilihan Menu Favorit</h2>
            <div class="row">
                @foreach($cirengs as $c)
                @if($cirengs->isEmpty())
    <p class="text-center">Maaf, menu cireng belum tersedia.</p>
@else
    @foreach($cirengs as $c)
        {{-- Kode kartu menu Anda --}}
    @endforeach
@endif
                <div class="col-md-4 mb-4">
                    <div class="card card-cireng shadow">
                        <img src="https://via.placeholder.com/300x200?text=Cireng+Munuu" class="card-img-top" alt="Cireng">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $c->nama_menu }}</h5>
                            <p class="text-muted small">Stok tersedia: {{ $c->stok }}</p>
                            <h4 class="text-danger fw-bold">Rp {{ number_format($c->harga) }}</h4>
                            <button class="btn btn-danger w-100 btn-pesan">Pesan Sekarang</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4 mt-5 text-center">
        <p>&copy; 2024 Warung Cireng Munu'u - Pemrograman 1 Tugas Besar</p>
    </footer>

</body>
</html>