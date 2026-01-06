/**
 * Alpine.js Component Registry
 * All Alpine components should be registered here to ensure they're available before Alpine.start()
 */

export function registerAlpineComponents(Alpine) {
    // Product Page Component
    Alpine.data('productPage', () => ({
        selectedImage: 0,
        quantity: 1,
        maxQuantity: 1,
        productId: null,
        selectedVariantId: null,
        loading: false,
        notifications: [],
        notificationIdCounter: 0,

        init(maxQty = 1, productId = null) {
            this.maxQuantity = Number(maxQty) || 1;
            this.productId = productId;
            this.quantity = (this.quantity && Number(this.quantity) > 0) ? Number(this.quantity) : 1;
            const q = document.getElementById('product-quantity');
            if (q) {
                q.value = String(this.quantity);
                q.dispatchEvent(new Event('input', { bubbles: true }));
            }
            this.attachVariantButtons();
        },

        attachVariantButtons() {
            const container = document.getElementById('product-variant-buttons');
            if (!container) return;
            container.querySelectorAll('.variant-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = btn.getAttribute('data-variant-id');
                    this.selectVariant(id, btn);
                });
            });
        },

        selectVariant(variantId, btnEl = null) {
            let btn = btnEl;
            if (!btn) btn = document.querySelector(`.variant-btn[data-variant-id="${variantId}"]`);
            if (!btn) return;
            document.querySelectorAll('.variant-btn').forEach(b => {
                b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'border-blue-400');
                b.classList.add('bg-white');
            });
            btn.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'border-blue-400');
            this.selectedVariantId = String(variantId || null);
            this.updateVariantUIFromElement(btn);
        },

        updateVariantUIFromElement(el) {
            const priceEl = document.getElementById('product-price');
            const oldEl = document.getElementById('product-old-price');
            const discEl = document.getElementById('product-discount');

            const vPrice = el.getAttribute('data-price');
            const vSale = el.getAttribute('data-sale');
            const vStock = el.getAttribute('data-stock');

            if (priceEl) {
                const display = (vSale && vSale !== '0') ? Number(vSale) : Number(vPrice);
                priceEl.textContent = `$${Number(display).toFixed(2)}`;
            }

            if (vSale && Number(vSale) > 0 && oldEl) {
                oldEl.textContent = `$${Number(vPrice).toFixed(2)}`;
                oldEl.classList.remove('hidden');
                if (discEl) {
                    const perc = Math.round((1 - (Number(vSale) / Number(vPrice || vSale))) * 100);
                    const offText = (discEl.dataset && discEl.dataset.offText) ? discEl.dataset.offText : 'off';
                    discEl.textContent = `${perc}% ${offText}`;
                    discEl.classList.remove('hidden');
                }
            } else if (oldEl) {
                oldEl.classList.add('hidden');
                if (discEl) discEl.classList.add('hidden');
            }

            this.maxQuantity = (vStock !== null && vStock !== undefined && vStock !== '') ? Number(vStock) : this.maxQuantity;
            if (Number(this.quantity) > Number(this.maxQuantity)) this.quantity = this.maxQuantity;
            const qEl = document.getElementById('product-quantity');
            if (qEl) {
                qEl.setAttribute('max', String(this.maxQuantity));
                qEl.value = String(this.quantity);
            }
        },

        get canAddToCart() {
            return this.maxQuantity > 0 && this.quantity > 0 && this.quantity <= this.maxQuantity;
        },

        incrementQuantity() {
            if (Number(this.quantity) < Number(this.maxQuantity)) {
                this.quantity = Number(this.quantity) + 1;
            }
        },

        decrementQuantity() {
            if (Number(this.quantity) > 1) {
                this.quantity = Number(this.quantity) - 1;
            }
        },

        async addToCart(productId = null) {
            if (!productId) productId = this.productId;
            const t = window.productTranslations || {};
            this.loading = true;
            try {
                const response = await fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity: this.quantity, variant_id: this.selectedVariantId })
                });
                const data = await response.json();

                if (data && data.success) {
                    this.showNotification(data.message || (t.added_to_cart || 'Added to cart'), 'success');
                    try { if (Alpine && Alpine.store && Alpine.store('global')) Alpine.store('global').increment('cart', this.quantity); } catch(e){}
                } else {
                    this.showNotification(data.message || (t.failed_to_add_to_cart || 'Failed to add to cart'), 'error');
                }
            } catch (err) {
                console.error('addToCart error', err);
                this.showNotification(t.network_error || 'Network error', 'error');
            } finally {
                this.loading = false;
            }
        },

        async addToWishlist(productId = null) {
            if (!productId) productId = this.productId;
            const t = window.productTranslations || {};
            this.loading = true;
            try {
                const response = await fetch(`/wishlist/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ variant_id: this.selectedVariantId })
                });
                const data = await response.json();

                let variantLabel = null;
                const selBtn = document.querySelector(`.variant-btn[data-variant-id="${this.selectedVariantId}"]`);
                if (selBtn) variantLabel = selBtn.getAttribute('data-attrs') || selBtn.getAttribute('data-sku');

                if (data && data.success) {
                    const what = variantLabel ? ` (${variantLabel})` : '';
                    this.showNotification((data.message || (t.added_to_wishlist || 'Added to wishlist')) + what, 'success');
                    try { if (Alpine && Alpine.store && Alpine.store('global')) Alpine.store('global').increment('wishlist', 1); } catch(e){}
                } else {
                    this.showNotification(data.message || (t.failed_to_add_to_wishlist || 'Failed to add to wishlist'), 'error');
                }
            } catch (err) {
                console.error('addToWishlist error', err);
                this.showNotification(t.network_error || 'Network error', 'error');
            } finally {
                this.loading = false;
            }
        },

        showNotification(message, type = 'success', productName = '') {
            const id = ++this.notificationIdCounter;
            this.notifications.push({ id, message, type, productName, show: true });
            if (this.notifications.length > 5) this.removeNotification(this.notifications[0].id);
            setTimeout(() => this.removeNotification(id), 4000);
        },

        removeNotification(id) {
            const idx = this.notifications.findIndex(n => n.id === id);
            if (idx !== -1) {
                this.notifications[idx].show = false;
                setTimeout(() => { this.notifications = this.notifications.filter(n => n.id !== id); }, 500);
            }
        },
    }));

    // Recently Viewed Products Component
    Alpine.data('rvComponent', () => {
        const KEY = 'rvp';
        const CURRENT_ID = window.currentProductId || 0;
        const CURRENT_PRODUCT = window.currentProductData || null;
        
        return {
            products: [],
            
            init() {
                if (!CURRENT_PRODUCT) return;
                
                let arr = [];
                try { 
                    arr = JSON.parse(localStorage.getItem(KEY) || '[]'); 
                } catch(e) { 
                    arr = []; 
                }
                
                this.products = arr.filter(x => x.id !== CURRENT_ID).slice(0, 4);
                
                arr = arr.filter(x => x.id !== CURRENT_ID);
                arr.unshift(CURRENT_PRODUCT);
                arr = arr.slice(0, 10);
                localStorage.setItem(KEY, JSON.stringify(arr));
            }
        };
    });

    // Recently Viewed Page Component (full page with all products)
    Alpine.data('recentlyViewedPage', () => {
        const KEY = 'rvp';
        
        return {
            products: [],
            
            init() {
                this.loadProducts();
            },
            
            loadProducts() {
                try {
                    this.products = JSON.parse(localStorage.getItem(KEY) || '[]');
                } catch(e) {
                    this.products = [];
                }
            },
            
            clearHistory() {
                localStorage.removeItem(KEY);
                this.products = [];
            }
        };
    });
}
