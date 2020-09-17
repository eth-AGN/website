/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function() {

  let loadingScreen = document.querySelector('.loading-screen');
  if (loadingScreen) {
    loadingScreen.classList.add('is-hidden');
  }
  
  document.querySelectorAll('.page_item a').forEach(link => {
    if (link.href) { 
      link.addEventListener('click', event => {
        event.preventDefault();
        link.blur();
        setTimeout(() => {
          window.location = link.href
        }, 150);
        link.parentElement.classList.add('is-expanded');
        loadingScreen.classList.remove('is-hidden');
      })
    }
  });

  const scrollThreshold = 16;
  function setBodyClassIfScrolled(cls) {
    const scrollTop = window.pageYOffset;
    if (scrollTop >= scrollThreshold) document.body.classList.add(cls);
    else document.body.classList.remove(cls);
  }

  window.addEventListener('scroll', () => {
    setBodyClassIfScrolled('is-scrolled');
  }, { passive: true });
  setBodyClassIfScrolled('is-scrolled');

})();
