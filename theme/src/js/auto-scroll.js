
const SCROLLING_SPEED = 100;

(function() {
  document.querySelectorAll('[data-auto-scroll]').forEach(el => {
    const wrapper = el.parentElement;
    let scrolling = false;

    let start = undefined;
    function scrollTick(t) {
      if (start === undefined) start = t;
      const dt = t - start;

      const maxScroll = Math.max(0, el.clientWidth - wrapper.clientWidth);
      const scrollAmount = Math.min(maxScroll, SCROLLING_SPEED*dt/1000);
      el.style.transform = `translateX(-${scrollAmount}px)`;

      if (scrolling) {
        window.requestAnimationFrame(scrollTick);
      } else {
        start = undefined;
      }
    }

    el.addEventListener('mouseover', () => {
      scrolling = true;
      wrapper.classList.add('is-scrolling');
      window.requestAnimationFrame(scrollTick);
    });

    el.addEventListener('mouseleave', () => {
      scrolling = false;
      wrapper.classList.remove('is-scrolling');
      el.style.transform = '';
    });
  })
})()