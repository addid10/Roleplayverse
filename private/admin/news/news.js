$(document).ready(function () {

	$('#photos').on('change', function () {
		let file = $(this).val();
		$(this).next('.custom-file-label').html(file);
		$(this).css('overflow', 'hidden');
	});

	$('#addButton').click(function () {
		$('#newsForm')[0].reset();
		$('.modal-title').text("Tambah Artikel");
		$('#action-button-news').val("Tambah");
		$('#news-operation').val("Add");
		$('#photos-news').html("");
	});

	//Read
	var dataTable = $('#newsTable').DataTable({
		ajax: "data.json",
		"serverSide": true,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		"order": [],

		"ajax": {
			url: "fetch.php",
			type: "POST"
		},
		"columnDefs": [{
			"targets": [0, 1, 2, 3, 4],
			"orderable": false,
		}],
	});

	//Add & Update
	$(document).on('submit', '#newsForm', function (event) {
		event.preventDefault();

		let title = $('#title').val();
		let author = $('#author-news').val();
		let contents = $('#contents').val();
		let category = $('#category').val();
		let photos = $('#photos').val().split('.').pop().toLowerCase();

		if (photos != '') {
			if ($.inArray(photos, ['png', 'jpg', 'jpeg']) == -1) {
				swal({
					position: 'top-end',
					type: 'error',
					width: 400,
					html: 'Masukkan File yang benar!',
					showConfirmButton: false,
					timer: 1500
				});
				$('#photos').val('');
				$('#photos').next('.custom-file-label').html('');
				return false;
			}
		}

		if (title !== '' && author !== '' && contents !== '' && category !== '') {
			$.ajax({
				url: "operation.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function () {
					$('#photos').next('.custom-file-label').html('');
					$('#newsForm')[0].reset();
					$('#newsModal').modal('hide');
					swal(
							'Berhasil!',
							'',
							'success'
						)
						.then(function () {
							dataTable.ajax.reload();
						});
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

	//Ambil Data
	$(document).on('click', '.update', function () {

		let id = $(this).attr("id");
		$.ajax({
			url: "fetch_single.php",
			type: "POST",
			data: {
				id: id
			},
			dataType: "json",
			success: function (data) {
				$('#newsForm')[0].reset();
				$('#newsModal').modal('show');
				$('.modal-title').text("Update News");

				$('#news-id').val(id);

				$('#title').val(data.title);
				$('#author-news').val(data.users);
				$('#contents').val(data.contents);
				$('#category').val(data.category);
				$('#photos-news').html(data.photos);

				$('#action-button-news').val("Update");
				$('#news-operation').val("Edit");
			}
		})
	});

	//Delete Data 
	$(document).on('click', '.delete', function () {
		let id = $(this).attr("id");
		swal({
				title: "Apakah anda yakin?",
				text: "Ada kemungkinan anda tidak bisa mengembalikkannya lagi.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Batal',
				confirmButtonText: 'Yakin!'
			})
			.then((result) => {
				if (result.value) {
					$.ajax({
						url: "delete.php",
						type: 'POST',
						data: {
							id: id
						},
						success: function () {
							swal(
									'Berhasil!',
									'File telah dihapus!',
									'success'
								)
								.then(function () {
									dataTable.ajax.reload();
								})
						}
					})
				}
			});
	})
});