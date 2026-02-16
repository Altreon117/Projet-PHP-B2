/**
 * Gestion de l'ajout au panier (cart.js).
 *
 * Gère le clic sur le bouton "ACHETER".
 * Envoie une requête AJAX pour ajouter l'item sélectionné au panier.
 */
document.addEventListener('DOMContentLoaded', () => {
    const buyButton = document.querySelector('.btn-purchase');

    if (buyButton) {
        buyButton.addEventListener('click', () => {
            const id = buyButton.dataset.id;
            
            if (!id) {
                alert("Veuillez sélectionner un objet d'abord.");
                return;
            }

            const itemData = {
                action: 'add',
                id: id,
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
                    location.reload();
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
