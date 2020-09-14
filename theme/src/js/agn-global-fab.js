
import * as d3 from 'd3';
import { interpolatePath } from 'd3-interpolate-path';

function getButtonRange(root, totalPadding) {
    const windowHeight = window.innerHeight;
    const buttonHeight = root.offsetHeight;
    return windowHeight - totalPadding - buttonHeight;
}

function createDragListeners(root, paddingTop, paddingBottom) {
    let isDragging = false;

    function handleMouseDown(e) {
        let rightClick = false;
        if ('touches' in e) { // handle touch events
            rightClick = e.touches.length != 1;
        } else if ("which" in e) { // Gecko (Firefox), WebKit (Safari/Chrome) & Opera
            rightClick = e.which == 3; 
        } else if ("button" in e) { // IE, Opera 
            rightClick = e.button == 2; 
        }

        if (!rightClick) {
            isDragging = true;
            window.addEventListener('mouseup', handleMouseUp);
            window.addEventListener('touchend', handleMouseUp);
            window.addEventListener('mouseleave', handleMouseUp);
            window.addEventListener('mousemove', handleMouseMove);
            window.addEventListener('touchmove', handleMouseMove);
        }
    }

    function handleMouseUp() {
        window.removeEventListener('mouseup', handleMouseUp);
        window.removeEventListener('touchend', handleMouseUp);
        window.removeEventListener('mouseleave', handleMouseUp);
        window.removeEventListener('mousemove', handleMouseMove);
        window.removeEventListener('touchmove', handleMouseMove);
        isDragging = false;
    }

    function handleMouseMove(e) {
        if (isDragging) {
            let mouseY = e.clientY;
            if (e.touches) {
                mouseY = e.touches[0].clientY;
            }

            let buttonRange = getButtonRange(root, paddingTop + paddingBottom);
            let buttonHeight = root.offsetHeight;

            let scrollPercent = (mouseY - paddingTop - buttonHeight/2) / buttonRange;
            let scrollPx = scrollPercent * (document.body.clientHeight - window.innerHeight);
            window.scrollTo(0, scrollPx);
        }
    }

    return {
        mousedown: handleMouseDown,
        touchstart: handleMouseDown
    }
}

(function() {
    const root = document.getElementById('global-fab');
    if (!root) throw new Error('No element with id "global-fab".');

    const button = root.querySelector('.the-button');
    if (!button) throw new Error('No button found inside global FAB.');

    const svg = button.querySelector('svg.icon-set');
    if (!svg) throw new Error('No SVG found inside global FAB.');

    const icons = svg.querySelector('.icons');
    if (!icons) throw new Error('No icon-group found inside global FAB.');

    const canvas = svg.querySelector('path.canvas');
    if (!canvas) throw new Error('No canvas-path found inside global FAB.');

    const initial = svg.querySelector('use.initial');
    if (!initial) throw new Error('No inital icon found inside global FAB');

    const searchAppendum = svg.querySelector('.search-appendum');



    /**
     * Move the FAB when user is scrolling down
     */

    const paddingTop = root.offsetTop;
    const paddingBottom = new Number(window.getComputedStyle(document.body).paddingBottom.replace('px', ''));
    window.addEventListener('scroll', event => {
        const windowHeight = window.innerHeight;
        const buttonHeight = root.offsetHeight;
        const scrollHeight = document.body.scrollHeight;
        const scrollTop = window.pageYOffset;

        // check if the user is able to scroll
        if (windowHeight < scrollHeight) {
            let scrollPercent = scrollTop / (scrollHeight - windowHeight);
            let buttonRange = getButtonRange(root, paddingTop + paddingBottom);
            root.style.transform = `translateY(${scrollPercent * buttonRange}px)`;
        }
    }, { passive: true });


    /**
     * Define actions and set global helper methods for changing them
     */
    
    console.log('initializing global fab');
    const initialAction = root.dataset.initialAction || 'blank';
    let currentAction = initialAction;
    
    const actions = {
        arrow: {
            cursor: 'pointer',
            title: 'Show search results',
            click() {
                console.log('arrow clicked');
            }
        },
        blank: {
            cursor: 'ns-resize',
            title: 'Drag to scroll page',
            ...createDragListeners(root, paddingTop, paddingBottom)
        },
        cross: {
            cursor: 'pointer',
            title: 'Close this post'
        },
        plus: {

        },
    }

    const eventTypes = ['click', 'mousedown', 'touchstart'];
    for (let type of eventTypes) {
        button.addEventListener(type, event => {
            const action = globalFab.actions[currentAction];
            if (action && typeof action[type] === 'function') action[type](event);
        }, { passive: true });
    }

    const paths = {};
    icons.querySelectorAll('path').forEach(path => {
        paths[path.id] = path.getAttribute('d');
    });
    console.log(paths);

    window.globalFab = {
        paths,
        actions,
        resetAction() {
            this.setAction(initialAction);
        },
        setAction(action) {
            if (this.actions[action]) {
                this.setIcon(action)
                currentAction = action;
                button.setAttribute('title', this.actions[action].title);
                button.style.cursor = this.actions[action].cursor;
            }
        },
        setIcon(id, duration) {
            if (duration === undefined) duration = 300;
            
            if (id == 'blank') {
                canvas.style.transform = 'scale(0)';

            } else if (this.paths[id] && canvas.dataset.iconId == 'blank') {
                canvas.setAttribute('d', this.paths[id]);
                canvas.style.transform = '';

            } else if (this.paths[id]) {
                if (canvas.dataset.iconId == 'search' && searchAppendum) {
                    searchAppendum.classList.remove('is-visible');
                } else if (id == 'search' && searchAppendum) {
                    searchAppendum.classList.add('is-visible');
                }

                const prev = canvas.getAttribute('d');
                const curr = this.paths[id];
                
                d3.select(canvas)
                .transition()
                .duration(duration)
                .attrTween('d', function () {
                    return interpolatePath(prev, curr);
                });

            } else {
                // unknown icon -> don't do anything
                return;
            }

            canvas.dataset.iconId = id;
        }
    }

    // let initialIcon = initial.getAttribute('href').replace('#', '');
    // globalFab.setIcon(initialIcon, 0)
    initial.style.display = 'none';

    globalFab.resetAction();

})()