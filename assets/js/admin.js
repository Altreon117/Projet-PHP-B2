document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.btn-delete-confirm');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.");

            if (!confirmation) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            } else {
                if (!btn.closest('form') && !btn.closest('a') && btn.tagName !== 'A') {
                    console.log("Suppression confirmée");
                    const row = btn.closest('tr');
                    if (row) {
                         row.style.transition = 'opacity 0.5s';
                         row.style.opacity = '0';
                         setTimeout(() => row.remove(), 500);
                    } else {
                         alert("Élément supprimé (simulation).");
                    }
                }
            }
        });
    });
});
