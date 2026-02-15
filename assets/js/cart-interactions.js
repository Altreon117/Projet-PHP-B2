document.addEventListener('DOMContentLoaded', () => {
    const updateCartTotal = () => {
        let total = 0;
        let count = 0;
        document.querySelectorAll('.cart-item-row').forEach(row => {
            const price = parseInt(row.dataset.price);
            const qty = parseInt(row.querySelector('.qty-input').value);
            total += price * qty;
            count += qty;
            
            row.querySelector('.cart-item-total-price').textContent = (price * qty) + ' PO';
        });

        const totalDisplay = document.getElementById('cart-total-price');
        const countDisplay = document.getElementById('cart-total-count');
        
        if (totalDisplay) totalDisplay.textContent = total; 
        if (countDisplay) countDisplay.textContent = count;
    };

    const cartContainer = document.querySelector('.others-items-spot');
    if (cartContainer) {
        cartContainer.addEventListener('click', (e) => {
            const target = e.target;
            const row = target.closest('.cart-item-row');
            if (!row) return;

            const input = row.querySelector('.qty-input');
            let value = parseInt(input.value);

            if (target.classList.contains('plus') || target.dataset.action === 'increase') {
                input.value = value + 1;
                updateCartTotal();
            } else if (target.classList.contains('minus') || target.dataset.action === 'decrease') {
                if (value > 1) {
                    input.value = value - 1;
                    updateCartTotal();
                }
            } else if (target.classList.contains('remove-btn')) {
                if (confirm('Retirer cet article du panier ?')) {
                    row.remove();
                    updateCartTotal();
                }
            }
        });
        updateCartTotal();
    }

    const clearBtn = document.querySelector('.clear-cart-btn');
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            if (confirm('Vider tout le panier ?')) {
                const rows = document.querySelectorAll('.cart-item-row');
                rows.forEach(row => row.remove());
                updateCartTotal();
            }
        });
    }

    const style = document.createElement('style');
    style.innerHTML = `
        .cart-item-row { display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid #444; color: #fff; background: rgba(0,0,0,0.5); margin-bottom: 5px; }
        .cart-item-info { display: flex; align-items: center; gap: 10px; }
        .cart-item-img { width: 40px; height: 40px; border: 1px solid #c8aa6e; }
        .cart-item-details { display: flex; flex-direction: column; }
        .cart-item-name { font-weight: bold; color: #f0e6d2; }
        .cart-item-unit-price { font-size: 0.8em; color: #888; }
        .cart-item-actions { display: flex; align-items: center; gap: 5px; }
        .qty-btn { background: #1e2328; border: 1px solid #c8aa6e; color: #c8aa6e; width: 25px; height: 25px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
        .qty-input { width: 40px; text-align: center; background: #010a13; border: 1px solid #333; color: #f0e6d2; }
        .remove-btn { background: #ff4444; border: none; color: white; width: 25px; height: 25px; cursor: pointer; margin-left: 10px; border-radius: 3px; font-weight: bold; }
        .cart-item-total-price { min-width: 60px; text-align: right; color: #c8aa6e; margin-left: 10px; }
    `;
    document.head.appendChild(style);
});
