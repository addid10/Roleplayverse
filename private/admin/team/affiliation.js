$(document).ready(function () {
	$('#addButton').click(function () {
		$('#affForm')[0].reset();
		$('.modal-title').text("Tambah Afiliasi");
		$('#action-button-affiliation').val("Tambah");
		$('#affiliation-operation').val("Add");
	});

	//Read
	var dataTable = $('#affTable').DataTable({
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
			"targets": [0, 1, 2, 3],
			"orderable": false,
		}, ],
	});

	//Add & Update
	$(document).on('submit', '#affForm', function (event) {
		event.preventDefault();
		let name = $('#affiliation-name').val();
		let description = $('#description').val();

		if (name !== '' && description) {
			$.ajax({
				url: "operation.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function () {
					$('#affForm')[0].reset();
					$('#affModal').modal('hide');
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
				$('#affForm')[0].reset();
				$('#affModal').modal('show');
				$('.modal-title').text("Update Data");


				$('#affiliation-id').val(id);
				$('#affiliation-name').val(data.name);
				$('#description').val(data.description);

				$('#action-button-affiliation').val("Update");
				$('#affiliation-operation').val("Edit");
			}
		})
	});

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


	// List Member Pada Afiliasi
	function fetchData(id) {
		$.ajax({
			url: "fetch_member.php",
			type: "POST",
			data: {
				id: id
			},
			dataType: "json",
			success: function (data) {
				$('#member-table').html(data);
				$('#list-affiliation-id').val(id);
			}
		});
	}

	// Cek List
	$(document).on('click', '.member', function (e) {
		e.preventDefault();
		let id = $(this).attr("id");
		$('#member-modal').modal('show');
		fetchData(id);
	});

	// Tambah Member
	$('#member-form').submit(function (e) {
		e.preventDefault();
		let name = $('member-name').val();
		let role = $('#role').val();
		let id = $('#list-affiliation-id').val();

		if (name !== '' & role !== '') {
			$.ajax({
				url: "add_member.php",
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
							html: 'Anggota sudah ada!',
						});
						$('#member-form')[0].reset();
					} else {
						fetchData(id);
						swal(
							'Berhasil!',
							'',
							'success'
						);
						$('#member-form')[0].reset();
					}
				}
			})
		}
	})

	// Hapus
	$(document).on('click', '.closed', function () {
		let id = $(this).attr("id");
		let affiliation = $('#list-affiliation-id').val();
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
						url: "delete_member.php",
						type: 'POST',
						data: {
							id: id
						},
						success: function () {
							fetchData(affiliation);
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