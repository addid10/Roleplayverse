$(document).ready(function () {

    $('#passwordAdmin').keypress(function (event) {
        if (event.keyCode == 13) {
            $('#loginButtonAdmin').click();
            $('#registrationButtonAdmin').click();
        }
    });

    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();

        if (username !== '' && password !== '') {
            $.ajax({
                url: "login_user.php",
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    window.location.href = data;
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

});