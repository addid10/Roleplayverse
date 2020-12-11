$(document).ready(function () {
    $('#contact-form').submit(function (event) {
        event.preventDefault();

        let name = $('#fname').val();
        let email = $('#email').val();
        let message = $('#message').val();

        if (name !== '' && email !== '' && message !== '') {
            $.ajax({
                url: "contact.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function () {
                    $('#contact-form')[0].reset();
                    swal(
                        'Berhasil!',
                        'Pesan anda telah terkirim!',
                        'success'
                    )
                }
            });
        } else {
            swal(
                '',
                'Masukkan data secara lengkap!',
                'error'
            );
        }
    });
});