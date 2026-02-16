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

    let selectedItem = null;
    const itemsGrid = document.querySelector('.items-grid');
    const detailsImgContainer = document.getElementById('details-img-container');
    const detailsName = document.getElementById('details-name');
    const detailsPrice = document.getElementById('details-price');
    const detailsDesc = document.getElementById('details-desc');
    const detailsId = document.getElementById('details-id');
    const trashIcon = document.getElementById('admin-delete-item-btn');

    window.updateDetailsPanel = function(id, name, price, desc, img, element) {
        if (selectedItem) selectedItem.style.border = 'none';
        
        let targetBorder = element.classList.contains('mini-icon') ? element.querySelector('.item-square') : element;
        if (!targetBorder) targetBorder = element;

        selectedItem = targetBorder;
        selectedItem.style.border = '2px solid #c8aa6e';

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
        
        const bigDisplay = document.querySelector('.big-item-display .item-square-big-item');
        if (bigDisplay) {
            bigDisplay.innerHTML = `<img src="${img}" style="width:100%;height:100%;object-fit:contain;">`;
        }
    };

    if (itemsGrid) {
        itemsGrid.addEventListener('click', (e) => {
            const item = e.target.closest('.item-square');
            if (!item) return;

            window.updateDetailsPanel(
                item.dataset.id,
                item.dataset.name,
                item.dataset.price,
                item.dataset.desc,
                item.dataset.img,
                item
            );
        });
    }

    const editLink = document.querySelector('.edit-link');
    if (editLink) {
        editLink.addEventListener('click', (e) => {
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

    if (trashIcon) {
        trashIcon.addEventListener('click', (e) => {
            e.preventDefault(); 
            e.stopPropagation();

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

function adminSelectItem(element) {
    const id = element.dataset.id;
    const name = element.dataset.name;
    const price = element.dataset.price;
    const desc = element.dataset.desc;
    const img = element.dataset.img;
    
    if(window.updateDetailsPanel) {
        window.updateDetailsPanel(id, name, price, desc, img, element);
    }
}
