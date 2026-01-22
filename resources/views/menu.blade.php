<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu - Warung Cireng Munu'u</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .bg-cream { background-color: #f5f5dc !important; }
        .text-dark-cream { color: #333 !important; }
        .navbar { background-color: #f5f5dc !important; }
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
            color: #ffc107;
            font-weight: 700;
            margin: 1rem 0;
        }
        .btn-pesan {
            background-color: #ffc107;
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            transition: background-color 0.3s;
            color: #333;
        }
        .btn-pesan:hover {
            background-color: #e6a800;
            color: #333;
        }
        .page-header {
            background: linear-gradient(135deg, #ffc107 0%, #ffdb58 100%);
            color: #333;
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

    <nav class="navbar navbar-expand-lg navbar-light bg-cream sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-dark-cream" href="{{ route('menu') }}">Cireng Munu'u</a>
            <div class="ms-auto">
                <a href="/" class="btn btn-outline-dark btn-sm me-2">Kembali Home</a>
                <a href="{{ route('cireng.index') }}" class="btn btn-outline-dark btn-sm">Admin Dashboard</a>
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
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title text-dark">💬 Pesan {{ $c->nama_menu }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('orders.store') }}" method="POST" onsubmit="return submitOrder(event, '{{ $c->id }}', '{{ $c->link_wa }}')">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="cireng_id" value="{{ $c->id }}">
                                            
                                            <div class="mb-3">
                                                <label for="nama_pelanggan_{{ $c->id }}" class="form-label">📝 Nama Anda</label>
                                                <input type="text" class="form-control" id="nama_pelanggan_{{ $c->id }}" name="nama_pelanggan" placeholder="Contoh: Budi Santoso" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="quantity_{{ $c->id }}" class="form-label">🔢 Jumlah Pesan</label>
                                                <input type="number" class="form-control" id="quantity_{{ $c->id }}" name="quantity" value="1" min="1" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="pesan_{{ $c->id }}" class="form-label">💬 Pesan Tambahan (Opsional)</label>
                                                <textarea class="form-control" id="pesan_{{ $c->id }}" rows="3" name="pesan_tambahan" placeholder="Catatan atau permintaan khusus..."></textarea>
                                            </div>

                                            <div class="alert alert-info small">
                                                <strong>ℹ️ Info:</strong> Pesanan Anda akan disimpan dan dikirim ke WhatsApp
                                            </div>

                                            <div class="alert alert-warning small">
                                                <strong>💰 Total:</strong> Rp <span id="total_{{ $c->id }}">{{ number_format($c->harga, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning text-dark fw-bold">
                                                💬 Pesan Sekarang
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Update total harga saat quantity berubah
                            const quantityInput{{ $c->id }} = document.getElementById('quantity_{{ $c->id }}');
                            const updateTotal{{ $c->id }} = function() {
                                const harga = {{ $c->harga }};
                                const qty = parseInt(this.value) || 1;
                                const total = harga * qty;
                                document.getElementById('total_{{ $c->id }}').textContent = new Intl.NumberFormat('id-ID').format(total);
                            };
                            
                            quantityInput{{ $c->id }}.addEventListener('change', updateTotal{{ $c->id }});
                            quantityInput{{ $c->id }}.addEventListener('input', updateTotal{{ $c->id }});
                        </script>
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

    <footer class="bg-cream py-4 mt-5 text-center">
        <div class="container">
            <p class="mb-0 text-dark-cream">&copy; Warung Cireng Munu'u</p>
            <p class="text-secondary mt-2">Renyah & Gurih! 🔥</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function submitOrder(event, cirengId, whatsappLink) {
            event.preventDefault();
            
            // Get form values
            const nama = document.getElementById(`nama_pelanggan_${cirengId}`).value;
            const quantity = document.getElementById(`quantity_${cirengId}`).value;
            const pesan = document.getElementById(`pesan_${cirengId}`).value;
            const form = event.target;
            
            // Validate
            if (!nama || !quantity) {
                alert('Mohon isi nama dan jumlah pesanan!');
                return false;
            }
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const token = csrfToken ? csrfToken.getAttribute('content') : document.querySelector('input[name="_token"]').value;
            
            // Create FormData
            const formData = new FormData();
            formData.append('_token', token);
            formData.append('cireng_id', cirengId);
            formData.append('nama_pelanggan', nama);
            formData.append('quantity', quantity);
            formData.append('pesan_tambahan', pesan);
            
            // Submit to server
            fetch('{{ route("orders.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Build WhatsApp message
                    let message = `Halo, saya ${nama}\n\n`;
                    message += `Saya ingin memesan:\n`;
                    message += `📦 Produk: ${data.nama_produk}\n`;
                    message += `🔢 Jumlah: ${quantity} porsi\n`;
                    message += `💰 Total: Rp ${data.total_harga_format}\n`;
                    
                    if (pesan && pesan.trim()) {
                        message += `\n📝 Catatan: ${pesan}`;
                    }
                    
                    message += `\n\nTerima kasih! 🙏`;
                    
                    // Extract phone number from WhatsApp link
                    const phoneNumber = whatsappLink.replace('https://wa.me/', '').split('?')[0];
                    const encodedMessage = encodeURIComponent(message);
                    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                    
                    // Close modal
                    const modalElement = document.getElementById(`pesanModal${cirengId}`);
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                    
                    // Show success alert
                    alert('✅ Pesanan berhasil! WhatsApp akan terbuka...');
                    
                    // Open WhatsApp
                    setTimeout(() => {
                        window.open(whatsappUrl, '_blank');
                    }, 500);
                    
                    // Reset form
                    form.reset();
                    document.getElementById(`quantity_${cirengId}`).value = '1';
                    document.getElementById(`total_${cirengId}`).textContent = new Intl.NumberFormat('id-ID').format({{ $c->harga ?? 0 }});
                } else {
                    alert('❌ Gagal memproses pesanan: ' + (data.message || 'Error tidak diketahui'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan: ' + error.message + '\nMohon coba lagi');
            });
            
            return false;
        }
    </script>
</body>
</html>
