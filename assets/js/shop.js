function selectItem(element) {
    // Récupération des données
    const id = element.dataset.id;
    const name = element.dataset.name;
    const price = element.dataset.price;
    const desc = element.dataset.stats; // Dans index.php c'est data-stats qui contient la description
    
    // Récupération de l'image source
    // Si c'est une mini-icon (gauche), l'image est dedans.
    let imgSrc = '';
    const imgElement = element.querySelector('img');
    if (imgElement) {
        imgSrc = imgElement.src;
    } else {
        // Cas items-grid (all-items.php) où l'image peut être en background ou dans une balise img interne
        // Vérifions si index.php utilise des balises img aussi dans la grille
    }
    
    // Gestion visuelle (Bordures)
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

    // Mise à jour du panneau (IDs Client)
    // Titre
    // Dans index.php structure: <div class ="item-header-text"><h2>Coiffe...</h2>
    // Il n'y a pas d'ID sur le h2 dans le code original de index.php -> Il faut les ajouter ou utiliser des querySelector
    // Mais pour faire simple, on va supposer qu'on peut ajouter les IDs ou sinon on cible via classe
    
    // Tentative de ciblage robuste
    const nameEl = document.querySelector('.selected-item-info h2') || document.getElementById('details-name');
    if(nameEl) nameEl.textContent = name;
    
    const priceEl = document.querySelector('.selected-item-info .gold-cost') || document.getElementById('details-price');
    if(priceEl) priceEl.textContent = price;
    
    const descEl = document.querySelector('.selected-item-info .description .stats') || document.getElementById('details-desc');
    // Note: index.php a une classe .stats pour la description
    if(descEl) descEl.textContent = desc;

    // Mise à jour de l'image en haut à gauche du panneau détails
    const littleDisplay = document.querySelector('.item-square-little-item');
    if (littleDisplay) {
        littleDisplay.innerHTML = imgSrc ? `<img src="${imgSrc}" style="width:100%;height:100%;object-fit:cover;">` : '';
    }

    // Mise à jour du bouton ACHETER
    const btn = document.querySelector('.btn-purchase');
    if (btn) {
        btn.dataset.id = id;
        btn.dataset.name = name;
        btn.dataset.price = price;
    }
}
