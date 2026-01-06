@extends('layouts.app')

@section('title', __('nav.recently_viewed'))

@push('styles')
    @vite('resources/css/pages/pages.css')
    @vite('resources/css/products/productindex.css')
@endpush

@section('content')
<div class="static-page recently-viewed-page" x-data="recentlyViewedPage()">
    <div class="container">
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[
            ['label' => __('nav.recently_viewed')]
        ]" />
        
        <div class="page-header">
            <h1 class="page-title">{{ __('nav.recently_viewed') }}</h1>
            <p class="page-subtitle">{{ __('products.recently_viewed_description') }}</p>
        </div>

        <!-- Products Grid -->
        <div x-show="products.length > 0" class="recently-viewed-content">
            <div class="recently-viewed-actions">
                <span class="products-count" x-text="products.length + ' ' + (products.length === 1 ? '{{ __('products.product_singular') }}' : '{{ __('products.products_plural') }}')"></span>
                <button @click="clearHistory()" class="clear-history-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                    </svg>
                    {{ __('products.clear_history') }}
                </button>
            </div>

            <div class="products-grid">
                <template x-for="product in products" :key="product.id">
                    <a :href="product.url" class="product-card">
                        <div class="product-image">
                            <img x-show="product.image" :src="product.image" :alt="product.name">
                            <div x-show="!product.image" class="product-placeholder">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-name" x-text="product.name"></h3>
                            <div class="product-price" x-text="'$' + product.price"></div>
                        </div>
                    </a>
                </template>
            </div>
        </div>

        <!-- Empty State -->
        <div x-show="products.length === 0" class="empty-state-container">
            <div class="empty-state">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h2>{{ __('products.no_recently_viewed') }}</h2>
                <p>{{ __('products.no_recently_viewed_description') }}</p>
                <a href="{{ route('products.index') }}" class="btn-primary">
                    {{ __('products.browse_products') }}
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.recently-viewed-page {
    padding: 2rem 0 4rem;
}

.page-header {
    text-align: center;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: var(--text-muted);
    font-size: 1rem;
}

.recently-viewed-content {
    max-width: 1200px;
    margin: 0 auto;
}

.recently-viewed-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 0 0.5rem;
}

.products-count {
    color: var(--text-muted);
    font-size: 0.95rem;
}

.clear-history-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text-muted);
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.clear-history-btn:hover {
    background: rgba(239, 68, 68, 0.1);
    border-color: #ef4444;
    color: #ef4444;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1.5rem;
}

.product-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    transition: all 0.2s ease;
}

.product-card:hover {
    border-color: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.product-image {
    aspect-ratio: 1;
    background: var(--bg);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-placeholder {
    color: var(--text-muted);
    opacity: 0.3;
}

.product-placeholder svg {
    width: 48px;
    height: 48px;
}

.product-info {
    padding: 1rem;
}

.product-name {
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text);
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-price {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--accent);
}

.empty-state-container {
    display: flex;
    justify-content: center;
    padding: 4rem 1rem;
}

.empty-state {
    text-align: center;
    max-width: 400px;
}

.empty-icon {
    color: var(--text-muted);
    opacity: 0.4;
    margin-bottom: 1.5rem;
}

.empty-state h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-muted);
    margin-bottom: 1.5rem;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: var(--accent);
    color: white;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

@media (max-width: 640px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .recently-viewed-actions {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}
</style>
@endsection
