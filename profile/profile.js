$(document).ready(function () {
    //Custom File Name
    $('#faceclaim').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })

    $('#change-profiles').submit(function (e) {
        e.preventDefault();
        let name = $('#myName').val();
        let phone = $('#phoneNumber').val();
        let location = $('#location').val();
        let picture = $('#picture').val().split('.').pop().toLowerCase();

        if (picture != '') {
            if ($.inArray(picture, ['png', 'jpg', 'jpeg']) == -1) {
                swal({
                    position: 'top-end',
                    type: 'error',
                    width: 400,
                    html: 'Masukkan File yang benar!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            }
        }


        if (name !== '' && location !== '' && phone !== '') {

            $.ajax({
                url: "update.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                        swal({
                            type: 'error',
                            width: 500,
                            title: 'Ukuran foto melebihi batas'
                        })

                    } else {
                        swal({
                                type: 'success',
                                width: 500,
                                title: 'Profile berhasil diperbaharui'
                            })
                            .then(function () {
                                window.location.reload();
                            })

                    }
                }
            })
        }
    })


    //Confirm Password
    $('#confirm-password').keyup(function () {
        let pass = $('#new-password').val();
        let confirm = $('#confirm-password').val();

        if (pass == confirm) {
            $('#confirm-password').addClass('is-valid').removeClass('is-invalid');
            $('#confirm-status').addClass('valid-feedback').removeClass('invalid-feedback').html("Password cocok!");
        } else {
            $('#confirm-password').addClass('is-invalid').removeClass('is-valid');
            $('#confirm-status').addClass('invalid-feedback').removeClass('valid-feedback').html("Password tidak cocok!")
        }
    });
    //Panjang Password
    $('#new-password').keyup(function () {
        let min = 8;
        let max = 16;
        $("#new-password").attr('minlength', min);
        $("#new-password").attr('maxlength', max);
        let pass = $('#new-password').val();

        if (pass.length < min) {
            $('#new-password').addClass('is-invalid');
            $('#password-status').addClass('invalid-feedback').html("Password terlalu pendek!");
        } else if (pass.length > max) {
            $('#new-password').addClass('is-invalid');
            $('#password-status').addClass('invalid-feedback').html("Passwrod terlalu panjang!");
        } else {
            $('#new-password').addClass('is-valid').removeClass('is-invalid');
            $('#password-status').addClass('valid-feedback').removeClass('invalid-feedback').html("Terlihat bagus!");
        }
    });

    //Change Password 
    $(document).on('submit', '#change-passwords', function (e) {
        e.preventDefault();
        let newPass = $('#new-password').val();
        let oldPass = $('#old-password').val();

        if (newPass !== '' && oldPass) {
            $.ajax({
                url: "change_password.php",
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data == 1) {
                        swal({
                            type: 'success',
                            width: 400,
                            html: 'Password berhasil diperbaharui!'
                        }).then(function () {
                            window.location.reload();
                        })
                    } else if (data == 0) {
                        swal({
                            type: 'error',
                            width: 400,
                            html: 'Password lama anda salah!'
                        });
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
    });


})