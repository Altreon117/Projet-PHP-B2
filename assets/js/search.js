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
                categoryFilters.forEach(f => f.classList.remove('selected-filter'));
                document.getElementById('filter-all-logo').classList.add('selected-filter');
            } else {
                if (filter.classList.contains('selected-filter')) {
                   filter.classList.remove('selected-filter');
                   document.getElementById('filter-all-logo').classList.add('selected-filter');
                } else {
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
            filter.classList.toggle('selected-filter');
            if(isCatalogPage) applyFilters();
        });
    });

    const clearFilterBtn = document.getElementById('filter-clear');
    if (clearFilterBtn) {
        clearFilterBtn.addEventListener('click', () => {
            statFilters.forEach(f => f.classList.remove('selected-filter'));
            categoryFilters.forEach(f => f.classList.remove('selected-filter'));
            document.getElementById('filter-all-logo').classList.add('selected-filter');
            if(searchInput) searchInput.value = '';
            if(isCatalogPage) applyFilters();
        });
    }

    if (isCatalogPage && !document.querySelector('.filter-square-horizontal.selected-filter')) {
        const allLogo = document.getElementById('filter-all-logo');
        if(allLogo) allLogo.classList.add('selected-filter');
    }

    function applyFilters() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const items = document.querySelectorAll('.items-grid .item-square');
        
        const activeCategoryBtn = document.querySelector('.filter-square-horizontal.selected-filter[data-filter-value]');
        const currentCategory = activeCategoryBtn ? activeCategoryBtn.getAttribute('data-filter-value') : 'all';

        const activeStatBtns = document.querySelectorAll('.filter-square-vertical.selected-filter[data-filter-value]');
        const activeStats = Array.from(activeStatBtns).map(btn => btn.getAttribute('data-filter-value'));

        items.forEach(item => {
            if(!item.dataset.role) return;

            const name = (item.dataset.name || '').toLowerCase();
            const role = (item.dataset.role || '').toLowerCase();
            const desc = (item.dataset.stats || '').toLowerCase();
            const isFav = item.dataset.fav === 'true';
            const itemStatsStr = item.getAttribute('data-filter-stats') || '';
            const itemStatsList = itemStatsStr.split(' ');

            let matchesSearch = !query || name.includes(query) || role.includes(query) || desc.includes(query);
            
            let matchesCategory = true;
            if (currentCategory === 'favorite') {
                matchesCategory = isFav;
            } else if (currentCategory && currentCategory !== 'all') {
                matchesCategory = role === currentCategory;
            }

            let matchesStats = true;
            if (activeStats.length > 0) {
                matchesStats = activeStats.every(stat => itemStatsList.includes(stat));
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
