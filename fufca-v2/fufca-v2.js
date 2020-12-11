let ashiap = document.getElementById("ashiap");
let audioRen = document.getElementById("audioRen");
let audioZeln = document.getElementById("audioZeln");


$(document).ready(function () {
    "use strict";
    $(".hexFront, .hexBack").click(function () {
        $(".hexFront")
            .css({
                transform: "rotateY(0deg)",
                opacity: 1
            })
            .next()
            .css({
                transform: "rotateY(180deg)",
                opacity: 0
            })

        $(this)
            .css({
                transform: "rotateY(180deg)",
                opacity: 0
            })
            .next()
            .css({
                transform: "rotateY(0deg)",
                opacity: 1
            })
            .end().prev()
            .css({
                transform: "rotateY(0deg)",
                opacity: 1
            });
    });
});

function stopAll() {
    $('audio').each(function () {
        this.pause(); // Stop playing
        this.currentTime = 0; // Reset time
    });
}

$('#hexTio').click(function () {
    ashiap.play();
});


$('#hexRen').on('click', function () {
    stopAll();
    audioRen.play();
    $(this).find('p').css('text-shadow', '0 0 4px #000');
});


$('#hexZeln').on('click', function () {

    stopAll();
    audioZeln.play();
    let image = $(this).find('img').attr("src");


    $('#narcissistic').modal('show');
    $('#photo').attr('src', image);
});


$('#hexEl').on('click', function () {


    $('#narcissisticTwo').modal('show');
    $('#photo-target').attr('src', 'fufca-anime-photos/eldul.jpg');
});

let click = true;
$('#changeBg').click(function(){
    if (click) {
        $('.hexInner').css('background-image','linear-gradient(to top, #2a7fa9 0%, #0e567a 10%, #1a6990 100%)');
        $('body').css('background-image', 'linear-gradient(to top, #47b7ee 0%, #36a5db 50%, #2b95c9 100%)');
        click = false;
    } else {
        $('.hexInner').css('background-image', 'linear-gradient(to top, #19e181 0%, #10c76f 10%, #10a960 100%)');
        $('body').css('background-image', 'linear-gradient(120deg, #00e1a3 0%, #bff671 100%)');
        click = true;
    }
})