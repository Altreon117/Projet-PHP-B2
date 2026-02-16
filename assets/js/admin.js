document.addEventListener('DOMContentLoaded', () => {
    // 1. GESTION DES BOUTONS DE SUPPRESSION (TABLEAUX UTILISATEURS)
    const userDeleteButtons = document.querySelectorAll('.user-action-btn.btn-delete-confirm');
    userDeleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
                e.preventDefault();
            }
        });
    });

    // 2. GESTION DE LA SÉLECTION D'ITEMS (GRILLE CENTRALE)
    let selectedItem = null;
    const itemsGrid = document.querySelector('.items-grid');
    const detailsImgContainer = document.getElementById('details-img-container');
    const detailsName = document.getElementById('details-name');
    const detailsPrice = document.getElementById('details-price');
    const detailsDesc = document.getElementById('details-desc');
    const detailsId = document.getElementById('details-id');
    const trashIcon = document.getElementById('admin-delete-item-btn');

    // Fonction de mise à jour du panneau (Utilisable par la grille et le panneau gauche)
    window.updateDetailsPanel = function(id, name, price, desc, img, element) {
         // Gestion visuelle de la sélection
        if (selectedItem) selectedItem.style.border = 'none';
        
        // Si element est un .mini-icon (gauche), la bordure est sur l'image interne
        // Si element est un .item-square (centre), la bordure est sur lui-même
        let targetBorder = element.classList.contains('mini-icon') ? element.querySelector('.item-square') : element;
        if (!targetBorder) targetBorder = element;

        selectedItem = targetBorder;
        selectedItem.style.border = '2px solid #c8aa6e';

        // Mise à jour textes
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

    // Délégation pour la grille centrale
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

    // 3. GESTION DE LA SUPPRESSION D'ITEM (VIA POUBELLE PANNEL)
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

// Fonction globale appelée par le onClick du panneau gauche
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
