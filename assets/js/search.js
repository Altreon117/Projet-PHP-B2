document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-filters input[type="text"]');
    const itemsGrid = document.querySelector('.items-grid');
    const isCatalogPage = !!itemsGrid;
    let currentCategory = 'all'; 
    let activeStatFilters = []; 
    
    if (searchInput) {
        let resultsContainer = null;
        if (!isCatalogPage) {
            resultsContainer = document.createElement('div');
            resultsContainer.className = 'search-results-dropdown';
            searchInput.parentNode.insertBefore(resultsContainer, searchInput.nextSibling);
            
            Object.assign(resultsContainer.style, {
                position: 'absolute',
                backgroundColor: 'rgba(0, 0, 0, 0.9)',
                border: '1px solid #785A28',
                width: searchInput.offsetWidth + 'px',
                maxHeight: '300px',
                overflowY: 'auto',
                zIndex: '1000',
                display: 'none'
            });

            window.addEventListener('resize', () => {
                 resultsContainer.style.width = searchInput.offsetWidth + 'px';
            });
            
            document.addEventListener('click', (e) => {
                if (resultsContainer && !searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                    resultsContainer.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            if (isCatalogPage) {
                applyFilters();
            } else {
                fetchSearchResults(query, resultsContainer);
            }
        });
    }

    const categoryFilters = document.querySelectorAll('.filter-square-horizontal[data-filter-value]');
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', () => {
            const val = filter.getAttribute('data-filter-value');
            if (val === 'all') {
                currentCategory = 'all';
                categoryFilters.forEach(f => f.classList.remove('selected-filter'));
                document.getElementById('filter-all-logo').classList.add('selected-filter');
            } else {
                if (currentCategory === val) {
                   currentCategory = 'all';
                   filter.classList.remove('selected-filter');
                   document.getElementById('filter-all-logo').classList.add('selected-filter');
                } else {
                   currentCategory = val;
                   categoryFilters.forEach(f => f.classList.remove('selected-filter'));
                   filter.classList.add('selected-filter');
                }
            }
            if(isCatalogPage) applyFilters();
        });
    });

    const statFilters = document.querySelectorAll('.filter-square-vertical[data-filter-value]');
    statFilters.forEach(filter => {
        filter.addEventListener('click', () => {
            const val = filter.getAttribute('data-filter-value');
            if (activeStatFilters.includes(val)) {
                activeStatFilters = activeStatFilters.filter(s => s !== val);
                filter.classList.remove('selected-filter');
            } else {
                activeStatFilters.push(val);
                filter.classList.add('selected-filter');
            }
            if(isCatalogPage) applyFilters();
        });
    });

    const clearFilterBtn = document.getElementById('filter-clear');
    if (clearFilterBtn) {
        clearFilterBtn.addEventListener('click', () => {
            activeStatFilters = [];
            statFilters.forEach(f => f.classList.remove('selected-filter'));
            currentCategory = 'all';
            categoryFilters.forEach(f => f.classList.remove('selected-filter'));
            document.getElementById('filter-all-logo').classList.add('selected-filter');
            if(searchInput) searchInput.value = '';
            if(isCatalogPage) applyFilters();
        });
    }

    function applyFilters() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const items = document.querySelectorAll('.items-grid .item-square');
        
        items.forEach(item => {
            const name = (item.dataset.name || '').toLowerCase();
            const role = (item.dataset.role || '').toLowerCase();
            const desc = (item.dataset.desc || '').toLowerCase();
            const isFav = item.dataset.fav === 'true';
            
            let matchesSearch = !query || name.includes(query) || role.includes(query) || desc.includes(query);
            
            let matchesCategory = true;
            if (currentCategory === 'favorite') {
                matchesCategory = isFav;
            } else if (currentCategory !== 'all') {
                matchesCategory = role === currentCategory;
            }

            let matchesStats = true;
            if (activeStatFilters.length > 0) {
                matchesStats = activeStatFilters.every(stat => {
                    const statVal = parseInt(item.dataset[stat] || '0');
                    return statVal > 0;
                });
            }

            if (matchesSearch && matchesCategory && matchesStats) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function fetchSearchResults(query, container) {
        if (query.length < 2) {
            container.style.display = 'none';
            container.innerHTML = '';
            return;
        }
        fetch(`/Projet-PHP-B2/core/search_items.php?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(items => {
                container.innerHTML = '';
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
                             window.location.href = `${targetPage}?search_id=${item.id}`;
                        });
                        div.addEventListener('mouseenter', () => div.style.backgroundColor = 'rgba(50, 50, 50, 0.8)');
                        div.addEventListener('mouseleave', () => div.style.backgroundColor = 'transparent');
                        container.appendChild(div);
                    });
                    container.style.display = 'block';
                } else {
                    const noResult = document.createElement('div');
                    noResult.textContent = "Aucun résultat";
                    noResult.style.padding = '10px';
                    noResult.style.color = '#888';
                    container.appendChild(noResult);
                    container.style.display = 'block';
                }
            })
            .catch(err => console.error(err));
    }

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
