document.addEventListener('DOMContentLoaded', () => {
    let selectedItem = null;

    const itemsGrid = document.querySelector('.items-grid');
    const detailsName = document.getElementById('details-name');
    const detailsPrice = document.getElementById('details-price');
    const detailsStats = document.getElementById('details-stats');
    const buyButton = document.querySelector('.btn-purchase');
    
    itemsGrid.addEventListener('click', (e) => {
        const item = e.target.closest('.item-square');
        if (!item || !itemsGrid.contains(item)) return;

        if (selectedItem) {
            selectedItem.style.borderColor = '';
        }

        selectedItem = item;
        selectedItem.style.borderColor = '#c8aa6e'; 
        selectedItem.style.borderWidth = '2px';
        selectedItem.style.borderStyle = 'solid';

        const name = item.dataset.name;
        const price = item.dataset.price;
        const stats = item.dataset.stats;

        if (detailsName) detailsName.textContent = name;
        if (detailsPrice) detailsPrice.textContent = price;
        if (detailsStats) detailsStats.textContent = stats;
    });

    if (buyButton) {
        buyButton.addEventListener('click', () => {
            if (!selectedItem) {
                alert("Veuillez sélectionner un objet d'abord.");
                return;
            }

            const itemData = {
                action: 'add',
                id: selectedItem.dataset.id,
                quantity: 1
            };
            
            fetch('/Projet-PHP-B2/core/cart_actions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(itemData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Article ajouté au panier !");
                } else {
                    alert("Erreur : " + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert("Une erreur est survenue.");
            });
        });
    }
});
