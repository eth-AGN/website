
(function() {
    console.log('entering search.js')
    const el = document.querySelector('#search-menu');
    if (!el) return;
    console.log(el)

    const button = document.querySelector('.search-icon');
    if (!button) return;
    console.log(button)

    const popup = document.querySelector('.search-popup');
    if (!popup) return;
    console.log(popup)

    function toggle() {
        el.classList.toggle('is-open');
        button.classList.toggle('is-open');
        popup.classList.toggle('is-open');
    }

    console.log('hi')
    button.addEventListener('click', toggle);

})()