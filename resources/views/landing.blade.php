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
        .bg-cream { background-color: #f5f5dc !important; }
        .text-dark-cream { color: #333 !important; }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://storage.googleapis.com/orc-assets/hNIxiInq2NHR3ad4MMkjOQ/processed/d04f1634-36ae-4d1d-95a8-ec8c0e16b1bd.jpg?X-Goog-Algorithm=GOOG4-RSA-SHA256&X-Goog-Credential=138813553141-compute%40developer.gserviceaccount.com%2F20260122%2Fauto%2Fstorage%2Fgoog4_request&X-Goog-Date=20260122T071255Z&X-Goog-Expires=86400&X-Goog-SignedHeaders=host&X-Goog-Signature=4d303fdf177349af2833ad63ae7842e2f33a50f6a335a1618edc7f9f066708e6d30d53a3a3dffd4c0929b5eaec88229c44975a8cfe1f29ee82860b3ed1c8900a676b82b472240b507f316d2d06af8ce21363dfa6788974fc68616e9f7104382f279be2b9516683e09d197213d8502bc8e86782e4d744158c6467400a9fd13467b962cd70f4b887ba9b897084d0e165fbdd0979773b8307be409142ff5ac6946e226e39c4fc2ba28034d3b2857e5f9a9cc2e991886e638f99c64c9bb486f62cc364fb539a0650f5a2a8bfbe1f7678b6d6ec0e1e32a9dcfd5ade095858d24eb00509d4c52559cf19c5f97df20ce39016222301cc3906cd808d75eac2fb57b9b4a6');
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

    <nav class="navbar navbar-expand-lg navbar-light bg-cream sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark-cream" href="#">Cireng Munu'u</a>
            <div class="ms-auto">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-dark btn-sm">Admin Dashboard</a>
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

    <footer class="bg-cream py-4 mt-0 text-center">
        <p class="text-dark-cream">&copy; Warung Cireng Munu'u </p>
    </footer>

</body>
</html>