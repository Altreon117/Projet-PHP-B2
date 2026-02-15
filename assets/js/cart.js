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
                id: selectedItem.dataset.id,
                name: selectedItem.dataset.name,
                price: parseInt(selectedItem.dataset.price),
                quantity: 1
            };
            
            console.log("Envoi au panier:", itemData);
            alert(`[SIMULATION] Article ajouté au panier :\nNom: ${itemData.name}\nPrix: ${itemData.price} PO`);
        });
    }
});
