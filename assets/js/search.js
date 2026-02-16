document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-filters input[type="text"]');
    if (!searchInput) return;

    const itemsGrid = document.querySelector('.items-grid');
    const isCatalogPage = !!itemsGrid;

    let resultsContainer = null;
    if (!isCatalogPage) {
        resultsContainer = document.createElement('div');
        resultsContainer.className = 'search-results-dropdown';
        resultsContainer.style.position = 'absolute';
        resultsContainer.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
        resultsContainer.style.border = '1px solid #785A28';
        resultsContainer.style.width = searchInput.offsetWidth + 'px';
        resultsContainer.style.maxHeight = '300px';
        resultsContainer.style.overflowY = 'auto';
        resultsContainer.style.zIndex = '1000';
        resultsContainer.style.display = 'none';
        
        searchInput.parentNode.insertBefore(resultsContainer, searchInput.nextSibling);

        window.addEventListener('resize', () => {
             resultsContainer.style.width = searchInput.offsetWidth + 'px';
        });
    }

    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase().trim();

        if (isCatalogPage) {
            filterCatalogItems(query);
        } else {
            fetchSearchResults(query);
        }
    });

    function filterCatalogItems(query) {
        const items = document.querySelectorAll('.items-grid .item-square');
        items.forEach(item => {
            const name = (item.dataset.name || '').toLowerCase();
            const stats = (item.dataset.stats || item.dataset.desc || '').toLowerCase();
            const role = (item.dataset.role || '').toLowerCase();
            
            if (name.includes(query) || stats.includes(query) || role.includes(query)) {
                item.style.display = 'block';
                item.classList.add('search-match');
            } else {
                item.style.display = 'none';
                item.classList.remove('search-match');
            }
        });
    }

    function fetchSearchResults(query) {
        if (query.length < 2) {
            resultsContainer.style.display = 'none';
            resultsContainer.innerHTML = '';
            return;
        }

        fetch(`/Projet-PHP-B2/core/search_items.php?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(items => {
                resultsContainer.innerHTML = '';
                if (items.length > 0) {
                    items.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'search-result-item';
                        div.style.display = 'flex';
                        div.style.alignItems = 'center';
                        div.style.padding = '10px';
                        div.style.borderBottom = '1px solid #333';
                        div.style.cursor = 'pointer';
                        
                        div.innerHTML = `
                            <img src="${item.image}" style="width:30px; height:30px; object-fit:contain; margin-right:10px;">
                            <div style="display:flex; flex-direction:column;">
                                <span style="color:#F0E6D2; font-weight:bold;">${item.nom}</span>
                                <span style="color:#C8AA6E; font-size:12px;">${item.prix} PO</span>
                            </div>
                        `;

                        div.addEventListener('click', () => {
                             const isAdmin = window.location.href.includes('admin');
                             const targetPage = isAdmin ? 'all-items_admin.php' : 'all-items.php';
                             window.location.href = `${targetPage}?search_id=${item.id}`; // On passera l'ID pour le sélectionner
                        });

                        div.addEventListener('mouseenter', () => div.style.backgroundColor = 'rgba(50, 50, 50, 0.8)');
                        div.addEventListener('mouseleave', () => div.style.backgroundColor = 'transparent');

                        resultsContainer.appendChild(div);
                    });
                    resultsContainer.style.display = 'block';
                } else {
                    const noResult = document.createElement('div');
                    noResult.textContent = "Aucun résultat";
                    noResult.style.padding = '10px';
                    noResult.style.color = '#888';
                    resultsContainer.appendChild(noResult);
                    resultsContainer.style.display = 'block';
                }
            })
            .catch(err => console.error(err));
    }
    
    document.addEventListener('click', (e) => {
        if (resultsContainer && !searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.style.display = 'none';
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const searchId = urlParams.get('search_id');
    if (isCatalogPage && searchId) {
        setTimeout(() => {
            const targetItem = document.querySelector(`.item-square[data-id="${searchId}"]`);
            if (targetItem) {
                targetItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                targetItem.click();
            }
        }, 500);
    }
});
