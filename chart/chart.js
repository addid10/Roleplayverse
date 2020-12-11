var imgs = document.images,
    len = imgs.length,
    counter = 0;

for(let i = 0; i <= len; i++) {
    if(i === len) {
    //   alert('All images loaded!');
    }
}

/*
$('.btn-rate').click(function () {
    let id = $(this).attr("id");

    $.ajax({
        url: "../rate/fetch_single.php",
        type: "POST",
        data: {
            id: id
        },
        dataType: "json",
        success: function (data) {
            $('#score-option').val(data.rate);
            $('#rate-action').val(data.action);
            $('#rate-id').val(data.id);
        }
    })
});

$('#score-form').submit(function (e) {
    e.preventDefault();
    let chara = $('.rate-character').val();
    let score = $('#score-option').val();
    if (chara !== '' && score !== null) {
        $.ajax({
            url: "../rate/operation.php",
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data == 0) {
                    $('#score-form')[0].reset();
                    $('#rate-modal').modal('hide');
                    swal(
                        'Berhasil!',
                        '',
                        'success'
                    ).then(function () {
                        window.location.reload();
                    });
                } else if (data == 1) {
                    window.location.href = '../users/login?status=Silahkan login terlebih dahulu!';
                }
            }
        })
    } else {
        swal({
            position: 'top-end',
            type: 'error',
            html: 'Isi data dengan benar!',
            showConfirmButton: false,
            timer: 1000
        })
    }
})

$('.btn-favorited').click(function () {
    let id = $(this).attr("id");

    $.ajax({
        url: "../favorites/add.php",
        type: "POST",
        data: {
            id: id
        },
        success: function (result) {
            if (result == 1) {
                window.location.href = '../users/login?status=Silahkan login terlebih dahulu!';
            } else if (result == 0 || result == 2) {
                location.reload();
            }
        }
    })
});
*/