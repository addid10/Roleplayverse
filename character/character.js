$('.favorites').click(function () {
    let id = $(this).attr("id");

    $.ajax({
        url: "../favorites/add.php",
        type: "POST",
        data: {
            id: id
        },
        success: function (data) {
            fetchFavorite(id);
            if (data == 1) {
                window.location.href = '../users/login?status=Silahkan login terlebih dahulu!';
            } else if (data == 0) {
                $('.text-favorite').text('Add to My Favorites!');
            } else {
                $('.text-favorite').text('Favorited');
            }
        }
    })
});

function fetchFavorite(id) {
    $.ajax({
        url: "../favorites/fetch.php",
        type: "POST",
        data: {
            id: id
        },
        dataType: "json",
        success: function (data) {
            $('#total-favorites').text(data);
        }
    });
}

function fetchScore(id) {
    $.ajax({
        url: "../rate/fetch_score.php",
        type: "POST",
        data: {
            id: id
        },
        dataType: "json",
        success: function (data) {
            $('#character-score').text(data);
        }
    });
}

$('.btn-rate-score').click(function () {
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

//Tambah Data
$('#score-form').submit(function (e) {
    e.preventDefault();
    let chara = $('#rate-character').val();
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
                if (data == 1) {
                    window.location.href = '../users/login?status=Silahkan login terlebih dahulu!';
                } else if (data == 0) {
                    fetchScore(chara);
                    $('#score-form')[0].reset();
                    $('#rate-modal').modal('hide');
                    swal(
                        'Berhasil!',
                        '',
                        'success'
                    );
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