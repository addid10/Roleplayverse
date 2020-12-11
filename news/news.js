$('#news-form').submit(function (e) {
    e.preventDefault();
    let comment = $('#comment').val();

    if (comment !== '') {
        $.ajax({
            url: "add_comment.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == 1) {
                    swal({
                        type: 'error',
                        confirmButtonColor: '#3c408f',
                        title: 'Anda dilarang menggunakan <>, #, dan $'
                    })
                } else {
                    window.location.reload();
                }
            }

        })
    }
})

$("#comment").keypress(function (e) {
    if(e.which == 13 && !e.shiftKey) {        
        $(this).closest("form").submit();
        e.preventDefault();
        return false;
    }
});