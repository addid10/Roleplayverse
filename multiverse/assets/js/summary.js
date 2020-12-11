function stopAll() {
    $('audio').each(function () {
        this.pause(); // Stop playing
        this.currentTime = 0; // Reset time
    });
}

let opening = document.getElementById("opening");
let kingdom = document.getElementById("kingdom");

Reveal.initialize({

    transition: 'concave',
    dependencies: [{
            src: 'plugin/markdown/marked.js'
        },
        {
            src: 'plugin/markdown/markdown.js'
        },
        {
            src: 'plugin/notes/notes.js',
            async: true
        },
        {
            src: 'plugin/highlight/highlight.js',
            async: true,
            callback: function () {
                hljs.initHighlightingOnLoad();
            }
        }
    ]
});

Reveal.configure({
  autoSlide: 9000
});

let kingdomSlide = true;
Reveal.addEventListener('slidechanged', function (event) {
    let getSlideNumber = Reveal.getSlidePastCount();
    if (getSlideNumber == 1 && kingdomSlide) {
        opening.play();
    }
    if (getSlideNumber == 5 && kingdomSlide) {
        stopAll();
        kingdom.play();
        kingdomSlide = false;
    }
});