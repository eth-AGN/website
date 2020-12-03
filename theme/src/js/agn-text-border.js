
/**
 * This component is responsible for generating the text border
 * as an SVG. The border must be generated for it to
 * be well-proportioned independent of screen size.
 * 
 * The border is also re-generated on resize.
 */

// construct SVG according to screen size
function createTextBorder(border) {
    const svg = border.querySelector('svg');
    if (svg == undefined) return;

    const borderPath = svg.querySelector('#curve');
    if (borderPath == undefined) return;

    const leftPath = svg.querySelector('#left');
    const rightPath = svg.querySelector('#right');

    const height = 200;
    const width = svg.clientWidth/svg.clientHeight*height;
    const padding = 5;
    const leftToCenter = 40
    const rightToCenter = 40
    svg.setAttribute('viewBox', `0 0 ${width} ${height}`);

    const d =
    // start left of the center bottom
    `M ${width/2 - padding - leftToCenter - 2.5}   ${height - padding}` +
    // bottom left corner
    `L ${2*padding} ${height - padding} Q ${padding} ${height - padding}, ${padding} ${height - 2*padding}` +
    // top left corner
    `L ${padding} ${2*padding} Q ${padding} ${padding}, ${2*padding} ${padding}` +
    // top right corner
    `L ${width - 2*padding} ${padding} Q ${width - padding} ${padding}, ${width - padding} ${2*padding}` +
    // bottom right corner
    `L ${width - padding} ${height - 2*padding} Q ${width - padding} ${height - padding}, ${width - 2*padding}   ${height - padding}` +
    // stop right of the middle bottom
    `L ${width/2 + padding + rightToCenter} ${height - padding}`
    .replace(/(\n|\s)+/g, ' ');
    borderPath.setAttribute('d', d);

    if (leftPath) {
        const d =
        // start left of the center bottom
        `M ${width/2 - padding - leftToCenter} ${height - 2.25}` +
        // bottom center
        `L ${width/2 - padding} ${height - 2.25}`
        .replace(/(\n|\s)+/g, ' ');
        leftPath.setAttribute('d', d);
    }

    if (rightPath) {
        const d =
        // start left of the center bottom
        `M ${width/2 + padding} ${height - 2.25}` +
        // bottom center
        `L ${width/2 + padding + rightToCenter} ${height - 2.25}`
        .replace(/(\n|\s)+/g, ' ');
        rightPath.setAttribute('d', d);
    }
}

(function() {
    const border = document.querySelector('.text-border');
    if (border == undefined) return;

    createTextBorder(border);
    window.addEventListener('resize', () => { createTextBorder(border) }, { passive: true });
})();