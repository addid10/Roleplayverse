//Login
let special = /^[0-9a-zA-Z\_]+$/

$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    let username = $('#username').val();
    let password = $('#password').val();
    let checking = special.test(username);
    
    if(checking!=='false') {
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
    }
});

//Validasi Username
$('#username').on('keyup', function (e) {
    e.preventDefault();
    let min = 6;
    let max = 20;
    $("#username").attr('minlength', min);
    $("#username").attr('maxlength', max);

    let username = $('#username').val().toLowerCase();
    let checking = special.test(username);

    if (username.length < min) {
        $('#username').addClass('is-invalid');
        $('#usernameStatus').addClass('invalid-feedback').html("Terlalu pendek!");
    } else if (username.length > max) {
        $('#username').addClass('is-invalid');
        $('#usernameStatus').addClass('invalid-feedback').html("Terlalu panjang!");
    } else {
        $.ajax({
            url: 'check_username.php',
            type: 'POST',
            data: {
                username: username
            },
            success: function (data) {
                if (data == "Terlihat bagus!") {
                    $('#username').addClass('is-valid').removeClass('is-invalid');
                    $('#usernameStatus').addClass('valid-feedback').removeClass('invalid-feedback').html(data);
                } else {
                    $('#username').addClass('is-invalid').removeClass('is-valid');
                    $('#usernameStatus').addClass('invalid-feedback').removeClass('valid-feedback').html(data);
                }
            }
        });
    }
});

//Validasi Email
$('#email').on('keyup', function (e) {
    e.preventDefault();
    let min = 10;
    let max = 40;
    $("#email").attr('minlength', min);
    $("#email").attr('maxlength', max);

    let email = $('#email').val();

    if (email.length > min && email.length < max) {
        $.ajax({
            url: 'check_email.php',
            type: 'POST',
            data: {
                email: email
            },
            success: function (data) {
                if (data == "Terlihat bagus!") {
                    $('#email').addClass('is-valid').removeClass('is-invalid');
                    $('#emailStatus').addClass('valid-feedback').removeClass('invalid-feedback').html(data);
                } else {
                    $('#email').addClass('is-invalid').removeClass('is-valid');
                    $('#emailStatus').addClass('invalid-feedback').removeClass('valid-feedback').html(data);
                }
            }
        });
    }
})

//Panjang Password
$('#password').keyup(function () {
    let min = 8;
    let max = 16;
    $("#password").attr('minlength', min);
    $("#password").attr('maxlength', max);
    let pass = $('#password').val();

    if (pass.length < min) {
        $('#password').addClass('is-invalid');
        $('#passwordStatus').addClass('invalid-feedback').html("Password terlalu pendek!");
    } else if (pass.length > max) {
        $('#password').addClass('is-invalid');
        $('#passwordStatus').addClass('invalid-feedback').html("Passwrod terlalu panjang!");
    } else {
        $('#password').addClass('is-valid').removeClass('is-invalid');
        $('#passwordStatus').addClass('valid-feedback').removeClass('invalid-feedback').html("Terlihat bagus!");
    }
})

//Confirm Password
$('#confirmPassword').keyup(function () {
    let pass = $('#password').val();
    let confirm = $('#confirmPassword').val();

    if (pass == confirm) {
        $('#confirmPassword').addClass('is-valid').removeClass('is-invalid');
        $('#confirmStatus').addClass('valid-feedback').removeClass('invalid-feedback').html("Password cocok!");
    } else {
        $('#confirmPassword').addClass('is-invalid').removeClass('is-valid');
        $('#confirmStatus').addClass('invalid-feedback').removeClass('valid-feedback').html("Password tidak cocok!")
    }
})

//Registrasi
$(document).on('submit', '#registForm', function (e) {
    e.preventDefault();
    let user = $('#username').val();
    let pass = $('#password').val();
    let email = $('#email').val();
    let rule = $('#agreement').is(':checked');
    let check = special.test(user);
    
    if(check !== "false") {
    if (user !== '' && pass !== '' && email !== '' && rule) {
        $.ajax({
            url: "signup_user.php",
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
        
    }
})