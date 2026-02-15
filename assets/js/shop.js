function selectItem(element) {
    const id = element.dataset.id;
    const name = element.dataset.name;
    const price = element.dataset.price;
    const stats = element.dataset.stats;
    const imgInfo = element.querySelector('img') ? element.querySelector('img').src : '';

    const allItems = document.querySelectorAll('.item-square, .mini-icon');
    allItems.forEach(i => {
        i.style.borderColor = '#785A28';
        i.style.borderWidth = '1px';
    });

    const target = element.classList.contains('mini-icon') ? element.querySelector('.item-square') : element;
    if (target) {
        target.style.borderColor = '#c8aa6e'; 
        target.style.borderWidth = '2px';
    }

    const nameEl = document.getElementById('details-name');
    if(nameEl) nameEl.textContent = name;
    
    const priceEl = document.getElementById('details-price');
    if(priceEl) priceEl.textContent = price;
    
    const statsEl = document.getElementById('details-stats');
    if(statsEl) statsEl.textContent = stats;
    
    const bigDisplay = document.querySelector('.big-item-display .item-square-big-item');
    if (bigDisplay) {
        bigDisplay.innerHTML = imgInfo ? `<img src="${imgInfo}" style="width:100%;height:100%;object-fit:contain;">` : '';
    }

    const littleDisplay = document.querySelector('.item-square-little-item');
    if (littleDisplay) {
        littleDisplay.innerHTML = imgInfo ? `<img src="${imgInfo}" style="width:100%;height:100%;object-fit:contain;">` : '';
    }

    const btn = document.querySelector('.btn-purchase');
    if (btn) {
        btn.dataset.id = id;
        btn.dataset.name = name;
        btn.dataset.price = price;
    }
}
