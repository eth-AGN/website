
/**
 * This component applies the global tag filter
 * by changing every link on the page after it has loaded.
 * It does this by appending a GET-parameter with all selected tags.
 */

(function() {
    const tags = window.sessionStorage['tag-filter'];
    if (!tags) return;

    for (let a of document.getElementsByTagName('a')) {
        if (!a.href) continue;

        const url = new URL(a.href);
        if (url.host = window.location.host) {
            url.searchParams.set('tag', tags);
            a.href = url.href;
        }
    }
})()