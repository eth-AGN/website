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
        }, 300);
        link.parentElement.classList.add('is-expanded');
        document.body.classList.add('nav-animation', `to-${link.dataset.to}`);
        loadingScreen.classList.remove('is-hidden');
      })
    }
  });

  const scrollThreshold = 0;
  function setBodyClassIfScrolled(cls) {
    const scrollTop = window.pageYOffset;
    if (scrollTop > scrollThreshold) document.body.classList.add(cls);
    else document.body.classList.remove(cls);
  }

  window.addEventListener('scroll', () => {
    setBodyClassIfScrolled('is-scrolled');
  }, { passive: true });
  setBodyClassIfScrolled('is-scrolled');

})();
