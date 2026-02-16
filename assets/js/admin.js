/**
 * Logique de l'administration (admin.js).
 *
 * Gère les interactions spécifiques aux administrateurs :
 * - Sélection et affichage des items avec options d'édition/suppression.
 * - Confirmation de suppression.
 * - Gestion du panneau de détails admin.
 */
document.addEventListener('DOMContentLoaded', () => {
    const userDeleteButtons = document.querySelectorAll('.user-action-btn.btn-delete-confirm');
    userDeleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
                e.preventDefault();
            }
        });
    });

    const itemsGrid = document.querySelector('.items-grid');
    if (itemsGrid) {
        itemsGrid.addEventListener('click', (e) => {
            const item = e.target.closest('.item-square');
            if (item) {
                adminSelectItem(item);
            }
        });
    }

    const editLink = document.querySelector('.edit-link');
    if (editLink) {
        editLink.addEventListener('click', (e) => {
            const detailsId = document.getElementById('details-id');
            const currentId = detailsId ? detailsId.dataset.currentId : null;
            
            if (!currentId) {
                e.preventDefault();
                alert("Veuillez d'abord sélectionner un item dans la liste.");
                return;
            }
            e.preventDefault();
            window.location.href = `all-items_admin_modif.php?id=${currentId}`;
        });
    }

    const trashIcon = document.getElementById('admin-delete-item-btn');
    if (trashIcon) {
        trashIcon.addEventListener('click', (e) => {
            e.preventDefault(); 
            e.stopPropagation();

            const detailsId = document.getElementById('details-id');
            const currentId = detailsId ? detailsId.dataset.currentId : null;
            
            if (!currentId) {
                alert("Veuillez d'abord sélectionner un item dans la liste.");
                return;
            }

            if (confirm("Êtes-vous sûr de vouloir supprimer cet item (ID: " + currentId + ") ? Action irréversible.")) {
                window.location.href = `core/delete_item.php?id=${currentId}`;
            }
        });
    }
});

window.updateDetailsPanel = function(id, name, price, desc, img, element) {
    const isFav = element && ((element.dataset.fav === 'true') || (element.getAttribute('data-fav') === 'true'));

    let selectedItem = document.querySelector('.item-square[style*="border"]');
    if (selectedItem) selectedItem.style.border = 'none';
    
    let targetBorder = element && element.classList.contains('mini-icon') ? element.querySelector('.item-square') : element;
    if (!targetBorder && element) targetBorder = element;

    if(targetBorder) targetBorder.style.border = '2px solid #c8aa6e';

    const detailsId = document.getElementById('details-id');
    const detailsName = document.getElementById('details-name');
    const detailsPrice = document.getElementById('details-price');
    const detailsDesc = document.getElementById('details-desc');
    const detailsImgContainer = document.getElementById('details-img-container');
    const bigDisplay = document.querySelector('.big-item-display .item-square-big-item');

    // ID display removed as requested
    
    if (detailsName) detailsName.textContent = name;
    if (detailsPrice) detailsPrice.textContent = price;
    if (detailsDesc) detailsDesc.innerHTML = desc;
    if (detailsImgContainer) {
        detailsImgContainer.innerHTML = `<img src="${img}" style="width:100%; height:100%; object-fit:cover;">`;
    }
    
    if (bigDisplay) {
        bigDisplay.innerHTML = `<img src="${img}" style="width:100%;height:100%;object-fit:contain;">`;
    }

    const btn = document.querySelector('.btn-purchase');
    if (btn) {
        btn.dataset.id = id;
        btn.dataset.name = name;
        btn.dataset.price = price;
    }

    const favBtn = document.getElementById('fav-btn');
    if (favBtn && element) {
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
};

function adminSelectItem(element) {
    const id = element.dataset.id || element.getAttribute('data-id');
    const name = element.dataset.name || element.getAttribute('data-name');
    const price = element.dataset.price || element.getAttribute('data-price');
    const desc = element.dataset.desc || element.getAttribute('data-desc') || element.dataset.stats || element.getAttribute('data-stats');
    const img = element.dataset.img || element.getAttribute('data-img');
    
    let finalImg = img;
    if (!finalImg) {
        const imgTag = element.querySelector('img');
        if (imgTag) finalImg = imgTag.src;
    }

    window.updateDetailsPanel(id, name, price, desc, finalImg, element);
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
            alert(`Succès Admin! Action: ${data.debug.action}. User ID: ${data.debug.user_id}, Item ID: ${data.debug.item_id}`);
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

            // Update grid
            if (typeof window.updateGrid === 'function') {
                window.updateGrid();
            }
        } else {
            alert('Erreur Admin: ' + data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Erreur réseau ou JS Admin: ' + err);
    });
}
