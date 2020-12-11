let countdown = document.getElementById("countdown");


$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    let password = $('#password').val();

    if (password !== '') {
        let timerInterval;
        let closeInSeconds = 5;
        Swal.fire({
            html: '<strong>5</strong>',
            timer: closeInSeconds * 1000,
            onBeforeOpen: () => {
                Swal.showLoading()
                countdown.play()
                timerInterval = setInterval(() => {
                    closeInSeconds--;
                    Swal.getContent().querySelector('strong')
                        .textContent = closeInSeconds;
                }, 1000)
            },
            onClose: () => {
                clearInterval(timerInterval);
                closeInSeconds = 5;
            }
        }).then((result) => {
            $.ajax({
                url: "index.login.php",
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data !== '') {
                        $('body').addClass('animated rotateOut delay-3s');
                        setTimeout(() => {
                            window.location.href = data;
                        }, 500);
                        
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Password is incorrect',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            })
        })
    } else {
        alert("Genius!");
    }
});