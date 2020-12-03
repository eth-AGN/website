/**
 * This component is responsible for animating the transition
 * between WISSEN, DENKEN, HANDELN.
 * 
 * This is achieved by listening for click-events on the navigation
 * links and preventing their default behaviour. A short time later
 * (enough for the animation to play), the navigation event is
 * executed artificially.
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
