<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail {{ $product['name'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="catalog-page">
        <section class="catalog-shell">
            <div class="catalog-content">
                <div class="brand">JET<span>or</span>BIT</div>
                <h1 class="catalog-title">{{ $product['name'] }}</h1>

                <div class="catalog-card detail-grid">
                    <div class="detail-row">
                        <span class="detail-label">Kategori</span>
                        <span class="detail-value">{{ $product['category'] }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Harga</span>
                        <span class="detail-value">Rp{{ number_format($product['price'], 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Stok</span>
                        @if ($product['stock'] > 0)
                            <span class="stock-badge">{{ $product['stock'] }} tersedia</span>
                        @else
                            <span class="stock-badge empty">Habis</span>
                        @endif
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">{{ $product['stock'] > 0 ? 'Tersedia' : 'Tidak tersedia' }}</span>
                    </div>
                </div>

                <div class="detail-actions">
                    <a class="back-button" href="{{ route('catalog.index') }}">Kembali</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
