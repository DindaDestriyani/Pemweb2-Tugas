<x-layout>
    <x-slot name="title"> Homepage </x-slot>

    <div class="container py-3">

        {{-- Section: Kategori Produk --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-size: 1.5rem;">Kategori Product</h3>
            <a href="{{ url('/categories') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Kategori</a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ url('/category/' . $category->slug) }}" class="card category-card text-decoration-none">
                        <div class="card category-card text-center h-100 py-3 border-0 shadow-sm">
                            <div class="mx-auto mb-2"
                                style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; background: #f5f9fb; border-radius: 55px;">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}"
                                    style="width: 35px; height: 30px; object-fit: contain;">
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title mb-1 text-dark">{{ $category->name }}</h6>
                                <p class="card-text text-muted small text-truncate">
                                    {{ $category->description }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Section: Produk --}}
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 style="font-size: 1.5rem;">Product Terbaru</h3>
                <a href="{{ url('/products') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Produk</a>
            </div>

            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100 shadow-sm">
                            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/350x200?text=Product+Image' }}"
                                class="card-img-top" alt="{{ $product->name }}">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-truncate">{{ $product->description }}</p>
                                <div class="mt-auto">
                                    <span class="fw-bold text-primary">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <a href="{{ route('product.show', $product->slug) }}"
                                        class="btn btn-outline-primary btn-sm float-end">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="alert alert-info">Belum ada produk pada kategori ini.</div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center w-100 mt-4">
                {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
            </div>

        </div>
    </div>
</x-layout>