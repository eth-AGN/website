
/**
 * This component distributes the children of the specified elements
 * in the number of columns specified by the CSS-property `grid-template-columns`.
 * It removes all whitespace between rows, so that the columns are contiguous
 * (e.g. like on Pinterest).
 * 
 * This is currently used on the DENKEN page.
 */

function createMagicGrid(el) {
    const children = el.querySelectorAll('.magic-grid > *');
    for (let child of children) child.style.gridArea = '';
    
    window.requestAnimationFrame(() => {
        const compStyles = window.getComputedStyle(el);
        const nColumns = compStyles.getPropertyValue('grid-template-columns').split(' ').length;
        const rowGap = Number(compStyles.getPropertyValue('row-gap').replace('px', ''));
        const containerHeights = Array(nColumns).fill(0);
    
        function minIndex(array) {
            const min = array.reduce((min, val) => Math.min(min, val), Infinity);
            return array.indexOf(min);
        }
    
        for (let childNode of children) {
            const col = minIndex(containerHeights);
            childNode.style.gridArea = `1 / ${col + 1}`;
            childNode.style.transform = `translateY(${containerHeights[col]}px)`;
            containerHeights[col] += childNode.offsetHeight + rowGap;
        }
    
        const height = containerHeights.reduce((max, val) => Math.max(max, val), 0) - rowGap;
        el.style.height = `${height}px`;
    })

}

(function() {
    document.querySelectorAll('[data-magic-grid]').forEach(el => {
        createMagicGrid(el);
        window.addEventListener('resize', () => { createMagicGrid(el) }, { passive: true });
        window.addEventListener('tinymce:init', () => { createMagicGrid(el) });
    })
})();