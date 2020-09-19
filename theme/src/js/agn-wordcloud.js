import WordCloud from 'wordcloud';

(function() {
    document.querySelectorAll('.wordcloud').forEach(el => {
        let list;
        try {
            list = JSON.parse(el.dataset.wordcloudList);
        } catch (error) {
            console.error('Unable to parse wordcloud data.')
            return;
        }
        
        if (!Array.isArray(list)) {
            console.error('Wordcloud data must be an array.');
            return;
        }

        for (let item of list) {
            item[0] = item[0].toUpperCase();
        }

        const maxSize = list.reduce((max, item) => Math.max(max, item[1]), 0)
        const minSize = list.reduce((min, item) => Math.min(min, item[1]), maxSize)

        function scale(size) {
            // log^2 scale, will be 0 for minSize and 1 for maxSize
            if (minSize == maxSize) return 1;
            else {
                const log = Math.log(size - minSize + 1) / Math.log(maxSize - minSize + 1)
                return log*log;
            }
        }

        const rootFontSize = Number(window.getComputedStyle(document.body).getPropertyValue('font-size').replace('px', ''));
        const minFontSize = rootFontSize;
        function fontSize(size) {
            // smallest element will be 0.5rem, biggest will be 2rem
            // but it will be clamped to minFontSize
            return Math.max((1.5*scale(size) + 0.5)*rootFontSize, minFontSize);
        }

        function initWordCloud() {
            WordCloud([el], {
                list: list,
                fontFamily: 'Helvetica Neue',
                weightFactor: fontSize,
                gridSize: 24,
                minRotation: 0,
                maxRotation: 0,
                drawOutOfBound: true,
                color: '',
                backgroundColor: '',
                shuffle: false
            });
    
        }

        initWordCloud();
        window.addEventListener('resize', () => {
            requestAnimationFrame(initWordCloud);
        });

        el.addEventListener('wordcloudstop', () => {
            el.querySelectorAll('span').forEach(span => {
                const link = document.createElement('a');
                const item = list.find(item => item[0] == span.innerHTML);
                link.innerHTML = item[0];

                // set attributes to values specified in options
                let options = item[2];
                for (let key of Object.keys(options)) {
                    link.setAttribute(key, options[key]);
                }

                // apply styles to element
                link.style.cssText = span.style.cssText;
                link.style.width = '';
                link.style.height = '';
                link.setAttribute('class', span.getAttribute('class'))

                // romve old element, attach new element to the DOM
                el.removeChild(span);
                el.appendChild(link);
            });

            // wait one frame for the client to render the new elements
            requestAnimationFrame(() => {
                window.dispatchEvent(new CustomEvent('wordcloud:ready'))
            });
        });
    })
})()