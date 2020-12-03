//import WordCloud from 'wordcloud';
import * as d3 from 'd3';
import cloud from 'd3-cloud';

/**
 * This component hooks up to any element with a class "wordcloud"
 * and tries to initialize a d3-cloud.
 * The component in search.js will hook up to this.
 */

function initWordCloud(el, words, fontSize, callback) {
    const width = el.clientWidth, height = el.clientHeight;

    var layout = cloud()
        .size([width, height])
        .words(words.map(function(d) {
            return {text: d[0], size: fontSize(d[1]), data: d[2]};
        }))
        .padding(5)
        .timeInterval(16)
        .spiral('rectangular')
        .rotate(function() { return 0; })
        .font("'Helvetica Neue', Helvetica, Arial, sans-serif")
        .fontSize(function(d) { return d.size; })
        .on("end", (words) => {
            
            d3.select(el).select('svg').remove();
            d3.select(el).append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")")
                .selectAll("text")
                .data(words)
                .enter().append("text")
                .style("font-size", function(d) { return d.size + "px"; })
                .style("font-family", "'Helvetica Neue', Helvetica, Arial, sans-serif")
                .attr("text-anchor", "middle")
                .attr('data-tag-slug', function(d) {
                    return d.data['data-tag-slug'];
                })
                .attr("transform", function(d) {
                    return "translate(" + [d.x, d.y] + ") rotate(0)";
                })
                .text(function(d) { return d.text; });
            requestAnimationFrame(callback);
        });

    layout.start();

}

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

        const maxSize = list.reduce((max, item) => Math.max(max, item[1]), 0) + 1;
        const minSize = list.reduce((min, item) => Math.min(min, item[1]), maxSize)
        let mainItem = [
            'CHARTER',
            maxSize,
            {
                'data-tag-slug': 'https://agn.arch.ethz.ch/forums/topic/charter-of-a-new-architecture/'
            }
        ];
        let mainItemIndex = list.findIndex(item => item[0].toUpperCase() == mainItem[0]);
        if (mainItemIndex >= 0) {
            list[mainItemIndex] = mainItem;
        } else {
            list.push(mainItem);
        }


        function scale(size) {
            // log^2 scale, will be 0 for minSize and 1 for maxSize
            if (minSize == maxSize) return 1;
            else {
                const log = Math.log(size - minSize + 1) / Math.log(maxSize - minSize + 1)
                return log*log;
            }
        }

        const rootFontSize = Number(window.getComputedStyle(document.body).getPropertyValue('font-size').replace('px', ''));
        const minFontSize = 0.5*rootFontSize;
        function fontSize(size) {
            const min = 0.5;
            const max = 1.5;
            // smallest element will be 0.5rem, biggest will be 2rem
            // but it will be clamped to minFontSize
            return Math.max(((max - min)*scale(size) + min)*rootFontSize, minFontSize);
        }

        function onWordcloudInit() {
            el.querySelectorAll('text').forEach(text => {
                let ctx = text.parentElement;
                let bbox = text.getBBox();

                var rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
                rect.setAttribute("x", bbox.x);
                rect.setAttribute("y", bbox.y);
                rect.setAttribute("width", bbox.width);
                rect.setAttribute("height", bbox.height);
                rect.setAttribute("transform", text.getAttribute('transform'))
                ctx.insertBefore(rect, text);
            });

            // wait one frame for the client to render the new elements
            requestAnimationFrame(() => {
                window.dispatchEvent(new CustomEvent('wordcloud:ready'))
            });
        }

        initWordCloud(el, list, fontSize, onWordcloudInit);

    })
})()