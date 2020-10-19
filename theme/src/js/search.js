
const globalTags = {
    initEventListeners() {
        document.querySelectorAll('.global-tags').forEach(el => {
            const display = el.querySelector('.global-tags-display');
            const status = el.querySelector('.global-tags-status');
            if (!display || !status) return;

            el.addEventListener('click', () => {
                if (window.searchPopup) {
                    window.searchPopup.openFilterPopup();
                }
            })
        })
    },
    displayGlobalTags() {
        if (!window.sessionStorage['tag-filter']) return;
        const tagString = window.sessionStorage['tag-filter'].split(',').join(', ');

        document.querySelectorAll('.global-tags').forEach(el => {
            const display = el.querySelector('.global-tags-display');
            const status = el.querySelector('.global-tags-status');
            if (!display || !status) return;

            if (tagString) {
                el.classList.add('is-active');
                display.textContent = tagString;
                status.textContent = 'Active filter';
            } else {
                el.classList.remove('is-active');
            }
        })
    }
};

(function() {
    const el = document.querySelector('#search-menu');
    if (!el) return;

    const button = document.querySelector('.search-icon');
    if (!button) return;

    const popup = document.querySelector('.search-popup');
    if (!popup) return;

    const form = popup.querySelector('.search-form');
    if (!form) return;

    const filterButton = popup.querySelector('.filter-button');
    if (!filterButton) return;

    const clearFilterButton = popup.querySelector('.clear-filter-button');
    if (!clearFilterButton) return;


    const tagString = window.sessionStorage['tag-filter'];
    const tags = new Set(tagString ? tagString.split(',') : []);

    if (tags.size > 0) {
        button.classList.add('is-active');
    } else {
        clearFilterButton.style.display = 'none';
    }

    globalTags.initEventListeners();
    globalTags.displayGlobalTags();

    const searchPopup = {
        isOpen: false,
        filterIsOpen: false,
        tags,
        toggle() {
            if (Boolean(button.dataset.disabled)) return;
            searchPopup.isOpen = !searchPopup.isOpen;
            el.classList.toggle('is-open');
            button.classList.toggle('is-open');
            popup.classList.toggle('is-open');
    
            if (searchPopup.filterIsOpen) {
                popup.classList.toggle('filter-is-open');
                searchPopup.redirectIfDirty();
            }
    
            if (searchPopup.isOpen) {
                window.globalFab.setAction('arrow');
            } else {
                searchPopup.redirectIfDirty();
                window.globalFab.resetAction();
            }
        },
        // show or hide filter panel
        toggleFilterPopup() {
            searchPopup.filterIsOpen = !searchPopup.filterIsOpen;
            popup.classList.toggle('filter-is-open', searchPopup.filterIsOpen);
            if (!searchPopup.filterIsOpen) {
                searchPopup.redirectIfDirty();
            }
        },
        openFilterPopup() {
            if (!this.isOpen) this.toggle();
            if (!this.filterIsOpen) this.toggleFilterPopup();
        },
        clearFilter() {
            searchPopup.tags.clear();
            window.sessionStorage['tag-filter'] = '';
            clearFilterButton.style.display = 'none';
            document.querySelectorAll('svg text.is-active').forEach(el => {
                deselectTag(el);
            })
        },
        // add or remove tag from filter list
        toggleTagFilter(event) {
            const el = event.target;
            const slug = el.dataset.tagSlug;
            console.log(el, slug)

            if (searchPopup.tags.has(slug)) {
                searchPopup.tags.delete(slug);
                deselectTag(el);
                window.sessionStorage['tag-filter'] = Array.from(searchPopup.tags);
            } else {
                searchPopup.tags.add(slug);
                selectTag(el);
                window.sessionStorage['tag-filter'] = Array.from(searchPopup.tags);
            }

            if (searchPopup.tags.size > 0) {
                button.classList.add('is-active');
                clearFilterButton.style.display = '';
            } else {
                button.classList.remove('is-active');
                clearFilterButton.style.display = 'none';
            }

            globalTags.displayGlobalTags();
        },
        // redirect user if any filters have been changed
        redirectIfDirty() {
            let oldTags = tagString ? tagString.split(',') : [];

            // check if the filters have changed
            let dirty = false;
            if (searchPopup.tags.size == oldTags.length) {
                for (let tag of oldTags) {
                    if (!searchPopup.tags.has(tag)) dirty = true;
                }
            } else {
                dirty = true;
            }

            // if yes, redirect to same lcation with new filters applied
            if (dirty) {
                const url = new URL(window.location);
                url.searchParams.set('tag', sessionStorage['tag-filter']);
                window.location = url;
            }
        },
        submitSearch() {
            form.submit();
        }
    }

    button.addEventListener('click', searchPopup.toggle);

    filterButton.addEventListener('click', searchPopup.toggleFilterPopup);

    clearFilterButton.addEventListener('click', searchPopup.clearFilter);

    function denkenToggleTagFilter(event) {
        searchPopup.toggleTagFilter(event);
        searchPopup.redirectIfDirty();
    }

    function selectTag(el) {
        el.classList.add('is-active');
        el.previousElementSibling.classList.add('is-active');
    }
    function deselectTag(el) {
        el.classList.remove('is-active');
        el.previousElementSibling.classList.remove('is-active');
    }

    // wait for the wordcloud to finish rendering until registering event listeners
    window.addEventListener('wordcloud:ready', event => {
        document.querySelectorAll('.search-popup__filter text').forEach(el => {
            const slug = el.dataset.tagSlug;
            if (tags.has(slug)) selectTag(el);
            
            el.addEventListener('click', searchPopup.toggleTagFilter);
        });
        document.querySelectorAll('.category-denken .site-main .wordcloud text').forEach(el => {
            const slug = el.dataset.tagSlug;
            if (tags.has(slug)) selectTag(el);
    
            el.addEventListener('click', denkenToggleTagFilter);
        })
    })

    window.searchPopup = searchPopup;

})()