let warning = document.getElementById("warning");

$('#start').click(function () {
    $("#labelStory").css('display', 'none');
    warning.play();
    $("#startThisStory").css('font-size', '40px');
    $("#startThisStory").addClass("animated flash ");
    $("#startThisStory").html('Bersiap untuk memasuki ringkasan cerita!');
    setTimeout(() => {
        $("#startThisStory").html(3);

    }, 2000);
    setTimeout(() => {
        $("#startThisStory").html(2);

    }, 3000);
    setTimeout(() => {
        $("#startThisStory").html(1);

    }, 4000);
    setTimeout(() => {
        $("startThisStory").html(0);

    }, 5000);

    setTimeout(() => {
        $("html").addClass("animated bounceOut");
    }, 5000);

    setTimeout(() => {
        window.location.href = 'summary';
    }, 5100);
})