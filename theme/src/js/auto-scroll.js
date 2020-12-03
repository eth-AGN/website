
/**
 * This component is used for horizontally scrolling
 * an element on-hover.
 * For an example, check out `content-wissen.php`.
 */

const SCROLLING_SPEED = 100;

(function() {
  document.querySelectorAll('[data-auto-scroll]').forEach(el => {
    const wrapper = el.parentElement;
    let scrolling = false;

    let start = undefined;
    function scrollTick(t) {
      if (start === undefined) start = t;
      const dt = t - start;

      const maxScroll = Math.max(0, el.scrollWidth - wrapper.clientWidth);
      const scrollAmount = Math.min(maxScroll, SCROLLING_SPEED*dt/1000);
      // console.log(el, wrapper)
      el.style.transform = `translateX(-${scrollAmount}px)`;

      if (scrolling) {
        window.requestAnimationFrame(scrollTick);
      } else {
        start = undefined;
        wrapper.classList.remove('is-scrolling');
        el.style.transform = '';
      }
    }

    el.addEventListener('mouseover', () => {
      scrolling = true;
      wrapper.classList.add('is-scrolling');
      window.requestAnimationFrame(scrollTick);
    });

    el.addEventListener('mouseleave', () => {
      scrolling = false;
      console.log(el.style.transform)
    });
  })
})()