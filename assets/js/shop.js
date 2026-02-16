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
    const isFav = element.dataset.fav === 'true';
    
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
    if(descEl) descEl.innerHTML = desc;

    const littleDisplay = document.querySelector('.item-square-little-item');
    if (littleDisplay) {
        littleDisplay.innerHTML = imgSrc ? `<img src="${imgSrc}" style="width:100%;height:100%;object-fit:cover;">` : '';
    }

    const bigDisplay = document.querySelector('.big-item-display .item-square-big-item');
    if (bigDisplay) {
        bigDisplay.innerHTML = imgSrc ? `<img src="${imgSrc}" style="width:100%;height:100%;object-fit:contain;">` : '';
    }

    const btn = document.querySelector('.btn-purchase');
    if (btn) {
        btn.dataset.id = id;
        btn.dataset.name = name;
        btn.dataset.price = price;
    }

    const favBtn = document.getElementById('fav-btn');
    if (favBtn) {
        favBtn.src = 'assets/img/logos/favorite.png';
        if (isFav) {
            favBtn.classList.add('active');
        } else {
            favBtn.classList.remove('active');
        }
        
        const newFavBtn = favBtn.cloneNode(true);
        favBtn.parentNode.replaceChild(newFavBtn, favBtn);
        
        newFavBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleFavorite(id, newFavBtn, element);
        });
    }
}

function toggleFavorite(itemId, btnIcon, itemElement) {
    fetch('core/toggle_favorite.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ itemId: itemId })
    })
    .then(res => {
        return res.text().then(text => {
            try {
                return JSON.parse(text);
            } catch (e) {
                alert("Erreur serveur (non-JSON): " + text.substring(0, 200));
                throw new Error("Réponse non-JSON");
            }
        });
    })
    .then(data => {
        if (data.success) {
            alert(`Succès! Action: ${data.debug.action}. User ID: ${data.debug.user_id}, Item ID: ${data.debug.item_id}`);
            const isFav = data.isFavorite;
            if (isFav) {
                btnIcon.classList.add('active');
            } else {
                btnIcon.classList.remove('active');
            }
            if (itemElement) itemElement.dataset.fav = isFav ? 'true' : 'false';
            
            document.querySelectorAll(`.item-square[data-id="${itemId}"]`).forEach(el => {
                el.dataset.fav = isFav ? 'true' : 'false';
            });

            if (typeof window.updateGrid === 'function') {
                window.updateGrid();
            }
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Erreur réseau ou JS: ' + err);
    });
}
