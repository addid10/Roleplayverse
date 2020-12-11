$(document).ready(function () {
	$('#addButton').click(function () {
		$('#charaForm')[0].reset();
		$('.modal-title').text("Tambah Karakter");
		$('#action-button-character').val("Tambah");
		$('#character-operation').val("Add");
		$('#chara-other').removeAttr('checked');
		$('#chara-male').removeAttr('checked');
		$('#chara-female').removeAttr('checked');
		$('#upload-faceclaim').html('');
	});

	//Custom File Name
	$('#faceclaim').on('change', function () {
		let name = $(this).val();
		$(this).next('.custom-file-label').html(name);
		$(this).css('overflow', 'none');
	});

	//Read
	var dataTable = $('#charaTable').DataTable({
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
			"targets": [0, 3, 4, 5, 6],
			"orderable": false,
		}, ],
	});

	//Add & Update
	$(document).on('submit', '#charaForm', function (event) {
		event.preventDefault();
		let fullname = $('#fullname').val();
		let nickname = $('#nickname').val();
		let author = $('#author').val();
		let firstAppearance = $('#first-appearance').val();
		let race = $('#race').val();
		let personality = $('#personality').val();
		let storyline = $('#storyline').val();
		let faceclaim = $('#faceclaim').val().split('.').pop().toLowerCase();
		let source = $('#character-source').val();

		if (faceclaim != '') {
			if ($.inArray(faceclaim, ['png', 'jpg', 'jpeg']) == -1) {
				swal({
					position: 'top-end',
					type: 'error',
					width: 400,
					html: 'Masukkan File yang benar!',
					showConfirmButton: false,
					timer: 1500
				});
				$('#faceclaim').val('');
				$('#faceclaim').next('.custom-file-label').html('');
				return false;
			}
		}

		if (fullname !== '' && nickname !== '' && author !== '' && firstAppearance !== '' && race !== '' && storyline !== '' && personality !== '' && source !== '') {
			$.ajax({
				url: "operation.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
                success: function (data) {
                    $('#faceclaim').next('.custom-file-label').html('');
                    if (data == 1) {
                        swal({
                            type: 'error',
                            width: 400,
                            title: 'Ukuran foto melebihi batas'
                        })

                    } else {
                        $('#charaForm')[0].reset();
                        $('#charaModal').modal('hide');
                        swal({
                                type: 'success',
                                width: 400,
                                title: 'Berhasil'
                            })
                            .then(function () {
                                dataTable.ajax.reload();
                            })

                    }
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
				$('#faceclaim').removeAttr('required');
				$('#charaForm')[0].reset();
				$('#charaModal').modal('show');
				$('.modal-title').text("Update Data");


				$('#character-id').val(id);
				$('#character-source').val(data.source);
				$('#author').val(data.author);
				$('#fullname').val(data.fullname);
				$('#nickname').val(data.nickname);

				if (data.gender == "M") {
					$('#chara-male').attr('checked', 'checked');
					$('#chara-female').removeAttr('checked');
					$('#chara-other').removeAttr('checked');
				} else if (data.gender == "F") {
					$('#chara-female').attr('checked', 'checked');
					$('#chara-male').removeAttr('checked');
					$('#chara-other').removeAttr('checked');
				} else {
					$('#chara-other').attr('checked', 'checked');
					$('#chara-male').removeAttr('checked');
					$('#chara-female').removeAttr('checked');
				}

				$('#first-appearance').val(data.debut);
				$('#quotes').val(data.quotes);
				$('#race').val(data.race);
				$('#age').val(data.age);
				$('#school').val(data.school);
				$('#partner').val(data.partner);
				$('#storyline').val(data.storyline);
				$('#personality').val(data.personality);
				$('#appearance').val(data.appearance);

				$('#upload-faceclaim').html(data.faceclaim);
				$('#action-button-character').val("Update");
				$('#character-operation').val("Edit");
			}
		})
	});

	// Character Score -- Admin
	$(document).on('click', '.score', function (e) {
		e.preventDefault();
		let id = $(this).attr("id");
		$.ajax({
			url: "fetch_score.php",
			type: "POST",
			data: {
				id: id
			},
			dataType: "json",
			success: function (data) {
				$('#character-score-modal').modal('show');
				$('.modal-title').text(data.name);
				$('#character-score-id').val(data.id);
				$('#contributor').val(data.contributor);
				$('#attraction').val(data.attraction);
			}
		});
	});
	// Submit Score -- Admin
	$(document).on('submit', '#character-score-form', function (e) {
		e.preventDefault();
		let contributor = $('#contributor').val();
		let attraction = $('#attraction').val();

		if (contributor !== '' && attraction !== '') {
			$.ajax({
				url: "add_score.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function () {
					$('#character-score-form')[0].reset();
					$('#character-score-modal').modal('hide');
					swal(
							'Berhasil!',
							'',
							'success'
						)
						.then(function () {
							dataTable.ajax.reload();
						});
				}
			})

		} else {

			swal(
				'',
				'Masukkan Angka Penilaian!',
				'error'
			);
		}
	})

	//Delete Data 
	$(document).on('click', '.delete', function () {
		let id = $(this).attr("id");
		swal({
				title: "Apakah anda yakin?",
				text: "Anda tidak akan bisa mengembalikannya lagi.",
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


	// List Roleplay
	function fetchData(id) {
		$.ajax({
			url: "fetch_roleplay.php",
			type: "POST",
			data: {
				id: id
			},
			dataType: "json",
			success: function (data) {
				$('#list-roleplay-table').html(data);
				$('#list-character-id').val(id);
			}
		});
	}

	$(document).on('click', '.roleplay', function (e) {
		e.preventDefault();
		let id = $(this).attr("id");
		$('#list-roleplay-modal').modal('show');
		fetchData(id);
	});

	// Tambah List Roleplay
	$('#list-roleplay-form').submit(function (e) {
		e.preventDefault();
		let name = $('#roleplay-character-name').val();
		let role = $('#role').val();
		let id = $('#list-character-id').val();

		if (name !== '' & role !== '') {
			$.ajax({
				url: "add_roleplay_character.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function (data) {
					console.log(data)
					if (data == 1) {
						swal({
							type: 'error',
							width: 400,
							html: 'Roleplay yang dimasukkan sudah ada!',
						});
						$('#list-roleplay-form')[0].reset();
					} else {
						fetchData(id);
						swal(
							'Berhasil!',
							'',
							'success'
						);
						$('#list-roleplay-form')[0].reset();
					}
				}
			})
		}
	})

	// Hapus
	$(document).on('click', '.closed', function () {
		let id = $(this).attr("id");
		let chara = $('#list-character-id').val();
		swal({
				title: "Apakah anda yakin?",
				text: "Anda tidak akan bisa mengembalikannya lagi.",
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
						url: "close.php",
						type: 'POST',
						data: {
							id: id
						},
						success: function () {
							fetchData(chara);
							swal(
								'Berhasil!',
								'',
								'success'
							);
						}
					})
				}
			});
	})
});