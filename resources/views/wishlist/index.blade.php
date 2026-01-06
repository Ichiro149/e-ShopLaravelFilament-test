@extends('layouts.app')

@section('title', __('wishlist.title') . ' - My Shop')

@push('styles')
    @vite('resources/css/wishlist/wishlistindex.css')
@endpush

@push('scripts')
    @vite('resources/js/wishlist/wishlistindex.js')
@endpush

@section('content')
<div x-data="wishlistPage()" class="wishlist-page">
    <!-- Toast Container -->
    <div class="toast-container">
        <template x-for="notification in notifications" :key="notification.id">
            <div x-show="notification.show"
                 x-transition:enter="toast-enter"
                 x-transition:enter-start="toast-enter-start"
                 x-transition:enter-end="toast-enter-end"
                 x-transition:leave="toast-leave"
                 x-transition:leave-start="toast-leave-start"
                 x-transition:leave-end="toast-leave-end"
                 :class="notification.type"
                 class="toast-notification">
                <div class="toast-icon">
                    <svg x-show="notification.type === 'success'" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                        <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                    </svg>
                    <svg x-show="notification.type === 'error'" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                        <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                    </svg>
                    <svg x-show="notification.type === 'info'" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                        <path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                    </svg>
                    <svg x-show="notification.type === 'warning'" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                        <path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm-40-160h80v-240h-80v240ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                    </svg>
                </div>
                <div class="toast-content">
                    <div class="toast-product-name" x-text="notification.productName"></div>
                    <div class="toast-message" x-text="notification.message"></div>
                </div>
                <button @click="removeNotification(notification.id)" class="toast-close" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </button>
                <div class="toast-progress"></div>
            </div>
        </template>
    </div>

    <div class="container">
        <!-- Breadcrumbs -->
        <nav class="breadcrumbs">
            <a href="{{ route('products.index') }}">{{ __('wishlist.home') }}</a>
            <span>/</span>
            <span>{{ __('wishlist.wishlist') }}</span>
        </nav>

        <!-- Page Header -->
        <header class="page-header">
            <h1>{{ __('wishlist.your_wishlist') }}</h1>
            <span class="count">{{ $wishlistItems->count() }} {{ __('wishlist.items') }}</span>
        </header>

        @if($wishlistItems->count() > 0)
            <div class="wishlist-grid">
                @foreach($wishlistItems as $item)
                    <article class="wishlist-card" data-product-id="{{ $item->product->id }}">
                        <div class="card-thumb">
                            @if($item->product->images->first())
                                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}">
                            @else
                                <div class="placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                </div>
                            @endif
                            <button type="button"
                                    @click.prevent="removeFromWishlist({{ $item->product->id }}, '{{ addslashes($item->product->name) }}')"
                                    class="remove-btn">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="card-body">
                            <h3><a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a></h3>
                            <p class="card-category">{{ $item->product->category?->name ?? $item->product->category()->first()?->name ?? __('wishlist.uncategorized') }}</p>

                            @if($item->variant)
                                @php
                                    $v = $item->variant;
                                    $attrs = is_array($v->attributes) ? collect($v->attributes)->map(fn($val,$k) => "$k: $val")->join(', ') : null;
                                    $variantLabel = $attrs ? $attrs : ($v->sku ?? '');
                                @endphp
                                <p class="text-sm text-gray-500">{{ $variantLabel }}</p>
                            @endif

                            <div class="price-row">
                                <div class="price">
                                    @php $priceSource = $item->variant ?? $item->product; @endphp
                                    @if($priceSource->sale_price)
                                        <span class="price-current price-sale">${{ number_format($priceSource->sale_price, 2) }}</span>
                                        <span class="price-old">${{ number_format($priceSource->price, 2) }}</span>
                                    @else
                                        <span class="price-current">${{ number_format($priceSource->price ?? 0, 2) }}</span>
                                    @endif
                                </div>
                                <span class="badge-stock {{ $item->product->stock_quantity > 0 ? 'in' : 'out' }}">
                                    {{ $item->product->stock_quantity > 0 ? __('wishlist.in_stock') : __('wishlist.out_of_stock') }}
                                </span>
                            </div>

                            <div class="card-actions">
                                <button type="button" 
                                        @click.prevent="addToCart({{ $item->product->id }}, '{{ addslashes($item->product->name) }}', '{{ addslashes($variantLabel ?? '') }}', {{ $item->variant_id ?? 'null' }})"
                                        :disabled="loading"
                                        class="btn-cart"
                                        {{ ($item->variant ? ($item->variant->stock_quantity <= 0) : ($item->product->stock_quantity <= 0)) ? 'disabled' : '' }}>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                                    </svg>
                                    {{ $item->product->stock_quantity > 0 ? __('wishlist.add_to_cart') : __('wishlist.out_of_stock') }}
                                </button>
                                <a href="{{ route('products.show', $item->product) }}" class="btn-view">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <h2>{{ __('wishlist.empty') }}</h2>
                <p>{{ __('wishlist.empty_description') }}</p>
                <a href="{{ route('products.index') }}" class="btn-browse">
                    {{ __('wishlist.browse_products') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</div>

<script>
// Pass translations to JS
window.wishlistTranslations = {
    added_to_cart: @json(__('wishlist.added_to_cart')),
    removed: @json(__('wishlist.removed')),
    error_removing: @json(__('wishlist.error_removing')),
    error_adding_cart: @json(__('wishlist.error_adding_cart')),
    empty_title: @json(__('wishlist.empty_title')),
    empty_text: @json(__('wishlist.empty_subtitle')),
    browse_products: @json(__('wishlist.browse_products')),
    failed_remove: @json(__('wishlist.error_removing')),
    failed_add: @json(__('wishlist.error_adding_cart')),
    network_error: @json(__('wishlist.network_error') ?? 'Network error')
};
</script>
@endsection