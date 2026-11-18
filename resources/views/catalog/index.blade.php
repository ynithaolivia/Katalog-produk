<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Produk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="catalog-page">
        <div class="catalog-container">
            <header class="page-header">
                <div>
                    <p class="eyebrow">Kasir</p>
                    <h1>Daftar Produk</h1>
                </div>
            </header>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <section class="panel form-panel">
                <h2>{{ $editingProduct ? 'Ubah Produk' : 'Tambah Produk' }}</h2>
                <form
                    action="{{ $editingProduct ? route('catalog.update', $editingProduct) : route('catalog.store') }}"
                    method="post"
                    class="product-form"
                >
                    @csrf
                    @if ($editingProduct)
                        @method('PUT')
                    @endif

                    <label>
                        Nama
                        <input type="text" name="name" value="{{ old('name', $editingProduct?->name) }}" required>
                    </label>
                    <label>
                        Kategori
                        <input type="text" name="category" value="{{ old('category', $editingProduct?->category) }}" required>
                    </label>
                    <label>
                        Harga
                        <input type="number" name="price" min="0" value="{{ old('price', $editingProduct?->price) }}" required>
                    </label>
                    <label>
                        Stok
                        <input type="number" name="stock" min="0" value="{{ old('stock', $editingProduct?->stock) }}" required>
                    </label>
                    <div class="form-actions">
                        <button class="button primary" type="submit">
                            {{ $editingProduct ? 'Simpan Perubahan' : 'Tambah' }}
                        </button>
                        @if ($editingProduct)
                            <a class="button secondary" href="{{ route('catalog.index') }}">Batal</a>
                        @endif
                    </div>
                </form>
            </section>

            <section class="panel">
                <form class="search-form" action="{{ route('catalog.index') }}" method="get">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Cari produk atau kategori">
                    <button class="button secondary" type="submit">Cari</button>
                </form>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($product->stock > 0)
                                            {{ $product->stock }} tersedia
                                        @else
                                            <span class="stock-empty">Habis</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row-actions">
                                            <a class="button edit" href="{{ route('catalog.index', ['edit' => $product->id]) }}">Edit</a>
                                            <form action="{{ route('catalog.destroy', $product) }}" method="post" onsubmit="return confirm('Hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button delete" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
