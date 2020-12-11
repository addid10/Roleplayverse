let dialogue = ["<i>Hari ini, 9 Juni 2019. Hari liburan sekolah.</i>",
    "<i>Semuanya terasa suntuk bagi mereka yang kurang bisa menghadapinya.</i>",
    "<i>Begitu-pula dengan gadis berkacamata ini.</i>",
    "<i>Ia memutuskan untuk pergi ke tempat yang sering dikunjunginya.</i>",
    "<i>Baru saja sampai. Ia malah melihat bayangan seseorang.</i>",
    "<i>Padahal sebelumnya tidak ada orang di sana.</i>",
    "Hei! Kau siapa?",
    "Pencuri?",
    "Polisi?",
    "Pembongkar gedung tua?",
    "Maling?",
    "Hmm...",
    "Riska kah?",
    "Tak ada yang berubah.",
    "Sangat mengejutkan orang sepertimu bisa ada di tempat tua ini.",
    "Tempat yang sudah terlupakan.",
    "Kau?? <i><b>mengingat-ngingat</b></i>",
    "Chandra? haha...",
    "Biarpun sudah terlupakan, ini masih menjadi tempat favoritku.",
    "Btw, sedang apa kau di sini?",
    "Ngomongnya terlalu cepat...",
    "Jadi, kau juga merapikan tempat ini?",
    "Jika terjadi pembangunan pasti bangunan ini akan lenyap... ",
    "Err.. iya. <i><b>memalingkan wajah</b></i> merapikan sekaligus menghilangkan rasa bosan.",
    "Aku kesini...",
    "Karena rasa ingin tahuku yang berlebihan.",
    "Sejak kejadian dulu, dimana semua saling menyalahkan atas kematiannya.",
    "Haha. <i><b>nada datar</b></i> Lagian aku sudah tidak peduli tentang itu.",
    "Percuma saja mencari tau, toh itu sudah berlalu.",
    "....",
    "Ya berlalu... Tapi—",
    "—ada kalanya aku merasa mereka yang di sana masih menyimpan ikatan,",
    "mereka tidak membuangnya.",
    "Dan satu hal yang sudah aku tau mengenai kematiannya adalah orang itu ingin bermain—",
    "—bermain bersama kita dengan senang hati sebelum kematiannya.",
    "Begitu mengharukan, tapi...",
    "Setelah aku masuk bangunan ini, itu terasa seperti orang yang sudah mati itu,",
    "ingin melihat kita kembali <b>utuh</b>.",
    "Ia tidak ingin kematiannya menghancurkan semuanya.",
    ".... ",
    "Tapi kau benar... itu sudah lama dan sudah berlalu.",
    ".... ",
    ".... ",
    "Errr...",
    "Jika kita berkumpul kembali ke sini,",
    "menurutmu apa yang akan terjadi? Apakah dia akan senang?",
    ".... ",
    "Semua orang juga mencintai namanya kesenangan dan kenangan yang terbaik.",
    "Jadi, tentu saja ia akan senang,",
    "bahkan ia sudah tidak sabar untuk menemui kesenangan itu...",
    "Kau benar. <i><b>menunduk</b></i>",
    "Btw, apa yang kau sudah ketahui? <i><b>awkward</b></i>",
    "Maaf, rasa kepoku mulai meningkat dan...",
    "Dan.. bisa jadi apa yang kita kira selama ini itu salah.",
    "Apa ya... Yang aku ketahui cuman dia sudah terkena penyakit mematikan. Selama ini—",
    "—dia merahasiakan-nya.",
    "Hanya itu yang ku ketahui dan seperti yang kukatakan sebelumnya—",
    "—ia ingin bermain bersama kita sebelum kematiannya...",
    "Ahh... Aku bahkan tidak tau tentang penyakit mematikan itu...",
    "Aku mulai terpikir untuk merayakan anniversary kematian dia di sini,",
    "bersama-sama, supaya dia senang.",
    ".... ",
    "Tapi, sepertinya itu akan sulit dilakukan...",
    "Keadaan akan sama seperti tahun-tahun sebelumnya, tidak akan ada yang mau...",
    "Tidak perlu acara itu.",
    "Yang penting semuanya bisa berkumpul lagi di sini.",
    "Itu udah bagus dan membuatnya senang...",
    "Kenapa tidak mencoba untuk tahun ini? ",
    "Keyakinanmu lebih besar dari sebelumnya, 'kan...",
    "Ikatan kali ini lebih dalam...",
    "Sepertinya orang itu <b>menghantui<b> semua orang biar bikin—",
    "—semuanya nostalgia mengingatnya.",
    "Tahun ini? Entahlah. Aku sudah lama tidak mengontak semuanya.",
    "Mungkin bisa kucoba lagi. Hehe. Mungkin...",
    "Cobalah... Kau mungkn bisa membuat semuanya berkumpul kembali.",
    "Tapi prediksinya pasti sulit...",
    "Okay~!",
    "Maukah lu ke sini, tanggal **-**-2019 untuk berkumpul bersama kembali?",
    "Sifatmu kembali... Aku tidak bisa menjawab sekarang...",
    "Tapi akan aku usahakan...",
    "Hehe. Itu sudah jawaban yang cukup.",
    "Gw pulang dulu mau coba cari-cari info kontak yang masih tersisa.",
    "Dadah~ <i><b>pergi lari</b></i>",
    ""
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
    $('audio').each(function () {
        this.pause(); // Stop playing
        this.currentTime = 0; // Reset time
    });
}

let opening = document.getElementById("opening");
let tbc = document.getElementById("tbc");


function story() {
    opening.play();
    $('.virtual-text-box').html(dialogue[textNumb]);
    if (textNumb == 6) {
        $('.character-faceclaim').css({
            'display': 'block'
        });
        $('.character-name').css('display', 'block');
        textNumb++;
    } else if (textNumb == 10) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('???');
        textNumb++;
    } else if (textNumb == 16) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 20) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 23) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 24) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 27) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 29) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 39) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 46) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 50) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 54) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 58) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 64) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 72) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 74) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 76) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 78) {
        $('#characterFaceclaim').html(faceClaim('Chandra'));
        $('.character-name').html('Chandra');
        textNumb++;
    } else if (textNumb == 80) {
        $('#characterFaceclaim').html(faceClaim('Riska'));
        $('.character-name').html('Riska');
        textNumb++;
    } else if (textNumb == 82) {
        $('.character-faceclaim').addClass('fadeOut delay-3s').removeClass("fadeIn delay-2s");
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