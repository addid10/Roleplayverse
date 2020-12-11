//Read
$(document).ready(function () {
	$('#addButton').click(function () {
		$('#addForm')[0].reset();
		$('.modal-title').text("Tambah Roleplay");
		$('#action-button').val("Tambah");
		$('#roleplay-operation').val("Add");
		$('#genres').multiselect('select', '');
		$('#multiverse-yes').removeAttr('checked');
		$('#multiverse-no').removeAttr('checked');
		$('#roleplay-stories').css('display', 'none');
		$('#roleplay-multiverse').css('display', 'none');
		$('#upload-image').html('');
	});

	$('#genres').multiselect({
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		buttonWidth: '100%'
	});

	//Custom File Name
	$('#cover').on('change', function () {
		//get the file name
		let fileName = $(this).val();
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(fileName);
		$(this).css('overflow', 'none');
	});

	$('#roleplay-type').change(function () {
		let type = $('#roleplay-type').val();

		if (type == "Roleplay Story") {
			$('#roleplay-stories').css('display', 'block');
			$('#chapters').attr('required', 'required');
			$('#roleplay-status').attr('required', 'required');
			$('#genres').attr('required', 'required');
			$('#multiverse-yes').attr('required', 'required');
			$('#multiverse-no').attr('required', 'required');
		} else {
			$('#roleplay-stories').css('display', 'none');
			$('#chapters').removeAttr('required');
			$('#roleplay-status').removeAttr('required');
			$('#genres').removeAttr('required');
			$('#multiverse-yes').removeAttr('required');
			$('#multiverse-no').removeAttr('required');
		}
	})
	$('#source').change(function () {
		let type = $('#source').val();

		if (type == "Fandom") {
			$('#roleplay-fandom').css('display', 'block');
			$('#fandom').attr('required', 'required');
		} else {
			$('#roleplay-fandom').css('display', 'none');
			$('#fandom').removeAttr('required');
		}
	})

	$('#multiverse-yes').change(function () {
		if ($(this).is(':checked')) {
			$('#roleplay-multiverse').css('display', 'block');
			$('#multiverse-code').attr('required', 'required');
			$('#multiverse-level').attr('required', 'required');
			$('#condition').attr('required', 'required');
			$('#multiverse-year').attr('required', 'required');
			$('#characteristic').attr('required', 'required');
			$('#worlds').attr('required', 'required');

		}
	});
	$('#multiverse-no').change(function () {
		if ($(this).is(':checked')) {
			$('#roleplay-multiverse').css('display', 'none');
			$('#multiverse-code').removeAttr('required');
			$('#multiverse-level').removeAttr('required');
			$('#condition').removeAttr('required');
			$('#multiverse-year').removeAttr('required');
			$('#characteristic').removeAttr('required');
			$('#worlds').removeAttr('required');
		}
	});

	var dataTable = $('#roleplayTable').DataTable({
		ajax: "data.json",
		"serverSide": true,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		"order": [],

		"ajax": {
			url: "fetch.php",
			type: "POST"
		},
		"columnDefs": [{
			"targets": [0, 4, 5, 6],
			"orderable": false,
		}, ],
	});

	//Add & Update
	$(document).on('submit', '#addForm', function (event) {
		event.preventDefault();
		let name = $('#roleplay-name').val();
		let date = $('#release-date').val();
		let creator = $('#creators').val();
		let source = $('#source').val();
		let type = $('#release-type').val();
		let cover = $('#cover').val().split('.').pop().toLowerCase();

		if (cover != '') {
			if ($.inArray(cover, ['png', 'jpg', 'jpeg']) == -1) {
				swal({
					position: 'top-end',
					type: 'error',
					width: 400,
					html: 'Masukkan File yang benar!',
					showConfirmButton: false,
					timer: 1500
				});
				$('#cover').val('');
				$('#cover').next('.custom-file-label').html('');
				return false;
			}
		}

		if (name !== '' && date !== '' && creator !== '' && type !== '' && source !== '') {
			$.ajax({
				url: "operation.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
                success: function (data) {
					$('#cover').next('.custom-file-label').html('');
                    if (data == 1) {
                        swal({
                            type: 'error',
                            width: 400,
                            title: 'Ukuran foto melebihi batas'
                        })

                    } else {
					    $('#addForm')[0].reset();
					    $('#addModal').modal('hide');
                        swal({
                                type: 'success',
                                width: 400,
                                title: 'Berhasil!'
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
				$('#addForm')[0].reset();
				$('#addModal').modal('show');
				$('.modal-title').text("Update Data");

				$('#roleplay-id').val(id);
				$('#roleplay-name').val(data.name);
				$('#othername').val(data.othername);
				$('#release-date').val(data.date);
				$('#creators').val(data.creators);
				$('#roleplay-type').val(data.type);

				if (data.source == "Original") {
					$('#source').val(data.source);
					$('#roleplay-fandom').css('display', 'none');
					$('#fandom').removeAttr('required', 'required');
				} else {
					$('#source').val("Fandom");
					$('#roleplay-fandom').css('display', 'block');
					$('#fandom').attr('required', 'required');
				}
				$('#fandom').val(data.source);

				if (data.type == "Roleplay Story") {
					$('#roleplay-stories').css('display', 'block');
					$('#chapters').attr('required', 'required');
					$('#roleplay-status').attr('required', 'required');
					$('#genres').attr('required', 'required');
					$('#multiverse-yes').attr('required', 'required');
					$('#multiverse-no').attr('required', 'required');
				} else {
					$('#roleplay-stories').css('display', 'none');
					$('#chapters').removeAttr('required');
					$('#roleplay-status').removeAttr('required');
					$('#genres').removeAttr('required');
					$('#multiverse-yes').removeAttr('required');
					$('#multiverse-no').removeAttr('required');
				}
				$('#chapters').val(data.chapters);
				$('#roleplay-status').val(data.status);
				$('#genres').multiselect('select', data.genres);

				if (data.verse == 1) {
					$('#multiverse-yes').attr('checked', 'checked');
					$('#multiverse-no').removeAttr('checked');
					$('#roleplay-multiverse').css('display', 'block');
					$('#multiverse-code').attr('required', 'required');
					$('#multiverse-level').attr('required', 'required');
					$('#condition').attr('required', 'required');
					$('#multiverse-year').attr('required', 'required');
					$('#characteristic').attr('required', 'required');
					$('#worlds').attr('required', 'required');
				} else {
					$('#multiverse-no').attr('checked', 'checked');
					$('#multiverse-yes').removeAttr('checked');
					$('#roleplay-multiverse').css('display', 'none');
					$('#multiverse-code').removeAttr('required');
					$('#multiverse-level').removeAttr('required');
					$('#condition').removeAttr('required');
					$('#multiverse-year').removeAttr('required');
					$('#characteristic').removeAttr('required');
					$('#worlds').removeAttr('required');
				}

				$('#multiverse-code').val('GSA');
				$('#multiverse-ranking').val(data.ranking);
				$('#multiverse-year').val(data.year);
				$('#condition').val(data.condition);
				$('#synopsis').val(data.synopsis);
				$('#characteristic').val(data.character);
				$('#worlds').val(data.world);

				$('#upload-image').html(data.cover);
				$('#cover').removeAttr('required');

				$('#action-button').val("Update");
				$('#roleplay-operation').val("Edit");
			}
		})
	});

	// Score Data
	$(document).on('click', '.score', function (e) {
		e.preventDefault();
		let id = $(this).attr("id");
		$.ajax({
			url: "score.php",
			type: "POST",
			data: {
				id: id
			},
			dataType: "json",
			success: function (data) {
				$('#score-modal').modal('show');
				$('.modal-title').text(data.name);
				$('#roleplay-score-id').val(data.id);
				$('#score-aov').val(data.score);
			}
		});
	});

	$(document).on('submit', '#score-form', function (e) {
		e.preventDefault();
		let score = $('#score-aov').val();

		if (score !== '') {
			$.ajax({
				url: "add_score.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function () {
					$('#score-form')[0].reset();
					$('#score-modal').modal('hide');
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


});