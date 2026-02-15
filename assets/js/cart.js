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
                    location.reload(); // Pour mettre à jour le panier si on est sur la page panier
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
