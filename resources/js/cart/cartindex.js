/**
 * Factory for cart page data
 */
function cartFactory() {
    return {
        items: [],
        loading: false,
        couponCode: '',

        init() {
            // Cart page initialized
        },

        updateQuantity(itemId, quantity) {
            if (quantity < 1) return this.removeItem(itemId);
            
            fetch(`/cart/update/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': window.getCsrfToken()
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Server error:', text);
                        throw new Error('Server error');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        },

        removeItem(itemId) {
            fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.getCsrfToken()
                }
            })
            .then(response => {
                if (response.ok) location.reload();
            })
            .catch(error => {
                console.error('Error removing item:', error);
            });
        },

        applyCoupon() {
            if (!this.couponCode || !this.couponCode.trim()) return;
            
            fetch('/cart/coupon/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.getCsrfToken()
                },
                body: JSON.stringify({ code: this.couponCode })
            })
            .then(response => {
                if (response.ok) location.reload();
                else {
                    return response.json().then(data => {
                        alert(data.message || 'Invalid coupon code');
                    });
                }
            })
            .catch(error => {
                console.error('Error applying coupon:', error);
            });
        },

        removeCoupon() {
            fetch('/cart/coupon/remove', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.getCsrfToken()
                }
            })
            .then(response => {
                if (response.ok) location.reload();
            })
            .catch(error => {
                console.error('Error removing coupon:', error);
            });
        }
    };
}

// Регистрируем глобально
window.cartPage = cartFactory;

// Регистрируем в Alpine если он уже загружен
if (window.Alpine) {
    window.Alpine.data('cartPage', cartFactory);
}

// Также регистрируем при инициализации Alpine
document.addEventListener('alpine:init', () => {
    Alpine.data('cartPage', cartFactory);
});

// Cart JS loaded