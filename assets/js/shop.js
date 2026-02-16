/**
 * Logique de la boutique publique (shop.js).
 *
 * Gère la sélection des items, l'affichage des détails dans le panneau latéral,
 * et les interactions utilisateur (clic sur un item).
 */
function selectItem(element) {
    const id = element.dataset.id;
    const name = element.dataset.name;
    const price = element.dataset.price;
    const desc = element.dataset.stats;
    
    let imgSrc = '';
    const imgElement = element.querySelector('img');
    if (imgElement) {
        imgSrc = imgElement.src;
    }
    
    const allItems = document.querySelectorAll('.item-square, .mini-icon .item-square');
    allItems.forEach(i => {
        i.style.borderColor = '#785A28';
        i.style.borderWidth = '1px';
    });

    const target = element.classList.contains('mini-icon') ? element.querySelector('.item-square') : element;
    if (target) {
        target.style.borderColor = '#c8aa6e'; 
        target.style.borderWidth = '2px';
    }

    const nameEl = document.querySelector('.selected-item-info h2') || document.getElementById('details-name');
    if(nameEl) nameEl.textContent = name;
    
    const priceEl = document.querySelector('.selected-item-info .gold-cost') || document.getElementById('details-price');
    if(priceEl) priceEl.textContent = price;
    
    const descEl = document.querySelector('.selected-item-info .description .stats') || document.getElementById('details-desc');
    if(descEl) descEl.textContent = desc;

    const littleDisplay = document.querySelector('.item-square-little-item');
    if (littleDisplay) {
        littleDisplay.innerHTML = imgSrc ? `<img src="${imgSrc}" style="width:100%;height:100%;object-fit:cover;">` : '';
    }

    const btn = document.querySelector('.btn-purchase');
    if (btn) {
        btn.dataset.id = id;
        btn.dataset.name = name;
        btn.dataset.price = price;
    }
}
