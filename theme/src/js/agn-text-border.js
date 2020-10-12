

// construct SVG according to screen size
function createTextBorder(border) {
    const svg = border.querySelector('svg');
    if (svg == undefined) return;

    const path = svg.querySelector('path');
    if (path == undefined) return;

    console.log(svg.clientWidth, svg.clientHeight)
    const height = 200;
    const width = svg.clientWidth/svg.clientHeight*height;
    const padding = 5;
    svg.setAttribute('viewBox', `0 0 ${width} ${height}`);

    const d =
    // start left of the center bottom
    `M ${width/2 - padding}   ${height - padding}` +
    // bottom left corner
    `L ${2*padding} ${height - padding} Q ${padding} ${height - padding}, ${padding} ${height - 2*padding}` +
    // top left corner
    `L ${padding} ${2*padding} Q ${padding} ${padding}, ${2*padding} ${padding}` +
    // top right corner
    `L ${width - 2*padding} ${padding} Q ${width - padding} ${padding}, ${width - padding} ${2*padding}` +
    // bottom right corner
    `L ${width - padding} ${height - 2*padding} Q ${width - padding} ${height - padding}, ${width - 2*padding}   ${height - padding}` +
    // stop right of the middle bottom
    `L ${width/2 + padding} ${height - padding}`
    .replace(/(\n|\s)+/g, ' ');
    path.setAttribute('d', d);
}

(function() {
    const border = document.querySelector('.text-border');
    if (border == undefined) return;

    createTextBorder(border);
    window.addEventListener('resize', () => { createTextBorder(border) }, { passive: true });
})();