let dialogue = ["Nona, saya sudah mengirimkan surat anda kepada para dewan. Saat ini, situasi diluar sana sangat berbahaya. Sebaiknya anda tidak kemana mana.",
    "<b><i>Kayo mengangguk. Tangannya melambai memberi aba aba kepada Yashao untuk segera pergi dari hadapannya.</i></b>",
    "<b><i>Kayo memperhatikan beda kecil di hadapannya dengan seksama. Ia meraih sarung tangan, kemudian mengenakannya.</i></b>",
    "Seperti batu endapan... Tidak, permukaannya terlalu halus untuk disebut <b>batu<b>.",
    "<b><i>Benda itu, benda ditangannya itu ia temukan tepat di depan pekarangan tempat ia berlindung selama ini.</i></b>",
    "<b><i>Sejak konflik semakin memanas dan senjata senjata diledakkan, ia kehilangan tempat tinggal dan seluruh pelayan serta pendampingnya.</i></b>",
    "<b><i>Hanya satu yang tersisa. Sayangnya, satu orang itu kurang bisa ia harapkan.</i></b>",
    "Bagaimana, ya. Cuma dia yang tersisa. Mau bagaimana lagi...",
    "<b><i>Kayo menghela nafasnya, kemudian kembali menatap benda asing itu. Dengan bantuan kaca pembesar, ia memperhatikan tiap sisi dan bagiannya dengan teliti.</i></b>",
    "Tunggu... <b><i>Kayo menyalakan lampu meja untuk melihat dengan lebih jelas.</i></b>",
    "<b><i>Sesuatu, ada sesuatu di dalam benda itu! Sesuatu itu bergerak, seperti berenang renang di dalamnya. Kayo menatap benda itu dengan tatapan jijik.</i></b>",
    "Makhluk aneh mulai keluar dari perut bumi. Apa ini tanda tanda kiamat?",
    "<b><i>Kayo meraih sebuah kotak antik yang berhasil ia selamatkan dari reruntuhan mansionnya yang mewah di pinggiran ibu kota.</i></b>",
    "<b><i>Tempat yang cocok untuk meletakkan penemuannya yang rapuh itu, karena di dalam kotak itu terdapat bantalan berlapis bludru.</i></b>",
    "<b><i>Kayo menutup kotaknya dengan hati hati, kemudian bangkit dari duduknya.</i></b>",
    "Akhir akhir ini banyak benda aneh yang muncul.",
    "Lihat, jika kita berhasil menemukan artefak kuno itu dan menyerahkannya kepada ahli sejarah di pemerintahan, kita bisa dapat tambahan ganjalan perut selama perang. Haha. Iya 'kan?",
    // "<b><i></i></b>",
    // "<b><i></i></b>",
    // "<b><i></i></b>",
    // "<b><i></i></b>",
    // "<b><i></i></b>",
];

let dialogueLength = dialogue.length;
let textNumb = 0;
let tbcDio = true;


$(document).click(function () {
    story();
});

$(document).keydown(function (e) {
    if (e.keyCode == 39 || e.keyCode == 40) {
        story();
    }
});

function faceClaim(name) {
    return '<img class="d-block animated fadeIn delay-2s mx-auto character-faceclaim" src="assets/characters/' + name + '.png">'
}

function stopAll() {
    $('.audio').each(function () {
        this.pause(); // Stop playing
        this.currentTime = 0; // Reset time
    });
}

let opening = document.getElementById("opening");
let tbc = document.getElementById("tbc");

//VA
let kayo01 = document.getElementById("kayo01");
let kayo02 = document.getElementById("kayo02");
let kayo03 = document.getElementById("kayo03");
let kayo04 = document.getElementById("kayo04");
let kayo05 = document.getElementById("kayo05");
let kayo06 = document.getElementById("kayo06");


function story() {
    opening.volume = 0.1;
    opening.play();
    $('.virtual-text-box').html(dialogue[textNumb]);
    if (textNumb == 0) {
        $('.character-faceclaim').css({
            'display': 'block'
        });
        $('.character-name').css('display', 'block');
        $('.character-name').html('Yashao');
        textNumb++;
    } else if (textNumb == 1) {
        $('#characterFaceclaim').html(faceClaim('Kayo'));
        $('.character-name').html('Kayo');
        textNumb++;
    } else if (textNumb == 3) {
        stopAll();
        kayo01.play();
        textNumb++;
    } else if (textNumb == 7) {
        stopAll();
        kayo02.play();
        textNumb++;
    } else if (textNumb == 9) {
        stopAll();
        kayo03.play();
        textNumb++;
    } else if (textNumb == 11) {
        stopAll();
        kayo04.play();
        textNumb++;
    } else if (textNumb == 15) {
        stopAll();
        kayo05.play();
        textNumb++;
    } else if (textNumb == 16) {
        stopAll();
        kayo06.play();
        textNumb++;
    } else if (textNumb == 83 && tbcDio) {
        $('.background').css({
            'background': 'url("assets/bg/tbc.jpg") no-repeat center center fixed',
            'background-size': 'cover'
        });
        $('.character-faceclaim').attr('src', 'assets/characters/Dio.gif');
        $('.character-faceclaim').removeClass("fadeOut delay-3s").addClass('bounceInUp delay-3s')
        $('.box').html("");
        stopAll();
        tbc.play();
        tbcDio = false;
    } else if (textNumb < dialogueLength - 1) {
        textNumb++;
    }

}