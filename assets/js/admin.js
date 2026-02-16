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
                // Appel via event listener
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

// Définition globale pour accès via onclick ET JS
window.updateDetailsPanel = function(id, name, price, desc, img, element) {
    console.log("updateDetailsPanel called for ID:", id); // DEBUG

    let selectedItem = document.querySelector('.item-square[style*="border"]');
    if (selectedItem) selectedItem.style.border = 'none';
    
    let targetBorder = element.classList.contains('mini-icon') ? element.querySelector('.item-square') : element;
    if (!targetBorder) targetBorder = element;

    if(targetBorder) targetBorder.style.border = '2px solid #c8aa6e';

    const detailsId = document.getElementById('details-id');
    const detailsName = document.getElementById('details-name');
    const detailsPrice = document.getElementById('details-price');
    const detailsDesc = document.getElementById('details-desc');
    const detailsImgContainer = document.getElementById('details-img-container');
    const bigDisplay = document.querySelector('.big-item-display .item-square-big-item');

    if (detailsId) {
        detailsId.textContent = "ID: " + id;
        detailsId.dataset.currentId = id;
        detailsId.style.display = 'block';
    }
    if (detailsName) detailsName.textContent = name;
    if (detailsPrice) detailsPrice.textContent = price;
    if (detailsDesc) detailsDesc.textContent = desc;
    if (detailsImgContainer) {
        detailsImgContainer.innerHTML = `<img src="${img}" style="width:100%; height:100%; object-fit:cover;">`;
    }
    
    if (bigDisplay) {
        bigDisplay.innerHTML = `<img src="${img}" style="width:100%;height:100%;object-fit:contain;">`;
    }
    
    const btn = document.querySelector('.btn-purchase');
    if (btn) {
        console.log("Updating Purchase Button with ID:", id); // DEBUG
        btn.dataset.id = id;
        btn.dataset.name = name;
        btn.dataset.price = price;
    } else {
        console.error("Purchase button not found!");
    }
};

function adminSelectItem(element) {
    console.log("adminSelectItem clicked");
    const id = element.dataset.id || element.getAttribute('data-id');
    const name = element.dataset.name || element.getAttribute('data-name');
    const price = element.dataset.price || element.getAttribute('data-price');
    const desc = element.dataset.desc || element.getAttribute('data-desc') || element.dataset.stats || element.getAttribute('data-stats');
    const img = element.dataset.img || element.getAttribute('data-img');
    
    // Fallback si img pas dans dataset mais dans balise img
    let finalImg = img;
    if (!finalImg) {
        const imgTag = element.querySelector('img');
        if (imgTag) finalImg = imgTag.src;
    }

    window.updateDetailsPanel(id, name, price, desc, finalImg, element);
}
