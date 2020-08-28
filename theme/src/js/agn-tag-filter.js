
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