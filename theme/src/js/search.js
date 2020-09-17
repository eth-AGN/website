
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


    const tagString = window.sessionStorage['tag-filter'];
    const tags = new Set(tagString ? tagString.split(',') : []);

    if (tags.size > 0) button.classList.add('is-active');

    const searchPopup = {
        isOpen: false,
        filterIsOpen: false,
        tags,
        toggle() {
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
        // add or remove tag from filter list
        toggleTagFilter(event) {
            const el = event.target;
            const slug = el.dataset.tagSlug;

            if (searchPopup.tags.has(slug)) {
                searchPopup.tags.delete(slug);
                el.classList.remove('is-active');
                window.sessionStorage['tag-filter'] = Array.from(searchPopup.tags);
            } else {
                searchPopup.tags.add(slug);
                el.classList.add('is-active');
                window.sessionStorage['tag-filter'] = Array.from(searchPopup.tags);
            }

            if (searchPopup.tags.size > 0) {
                button.classList.add('is-active');
            } else {
                button.classList.remove('is-active');
            }
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

    // wait for the wordcloud to finish rendering until registering event listeners
    window.addEventListener('wordcloud:ready', () => {
        document.querySelectorAll('.search-popup__filter a').forEach(el => {
            const slug = el.dataset.tagSlug;
            if (tags.has(slug)) el.classList.add('is-active');
    
            el.addEventListener('click', searchPopup.toggleTagFilter);
        });
    })

    window.searchPopup = searchPopup;

})()