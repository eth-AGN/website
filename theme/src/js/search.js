
(function() {
    const el = document.querySelector('#search-menu');
    if (!el) return;

    const button = document.querySelector('.search-icon');
    if (!button) return;

    const popup = document.querySelector('.search-popup');
    if (!popup) return;

    const filterButton = popup.querySelector('.filter-button');
    if (!filterButton) return;

    function toggleSearchPopup() {
        el.classList.toggle('is-open');
        button.classList.toggle('is-open');
        popup.classList.toggle('is-open');

        if (filterIsOpen) {
            popup.classList.toggle('filter-is-open');
            redirectIfDirty();
        }
    }

    button.addEventListener('click', toggleSearchPopup);

    const tagString = window.sessionStorage['tag-filter'];
    const tags = new Set(tagString ? tagString.split(',') : []);
    let filterIsOpen = false;

    // redirect user if any filters have been changed
    function redirectIfDirty() {
        let oldTags = new Set(tagString ? tagString.split(',') : []);

        // check if the filters have changed
        let dirty = false;
        if (tags.size == oldTags.size) {
            for (let tag of tags) {
                if (!oldTags.has(tag)) dirty = true;
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
    }

    // show or hide filter panel
    function toggleFilterPopup() {
        filterIsOpen = !filterIsOpen;
        popup.classList.toggle('filter-is-open', filterIsOpen);
        if (!filterIsOpen) {
            redirectIfDirty();
        }
    }

    // add or remove tag from filter list
    function toggleTagFilter(event) {
        const el = event.target;
        const slug = el.dataset.tagSlug;

        if (tags.has(slug)) {
            tags.delete(slug);
            el.classList.remove('is-active');
            window.sessionStorage['tag-filter'] = Array.from(tags);
        } else {
            tags.add(slug);
            el.classList.add('is-active');
            window.sessionStorage['tag-filter'] = Array.from(tags);
        };
    }

    filterButton.addEventListener('click', toggleFilterPopup);

    // wait for the wordcloud to finish rendering until registering event listeners
    window.addEventListener('wordcloud:ready', () => {
        document.querySelectorAll('.search-popup__filter a').forEach(el => {
            const slug = el.dataset.tagSlug;
            if (tags.has(slug)) el.classList.add('is-active');
    
            el.addEventListener('click', toggleTagFilter);
        });
    })

})()