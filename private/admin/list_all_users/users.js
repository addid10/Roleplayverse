//Read
$(document).ready(function () {
	let dataTable = $('#listAllUsers').DataTable({
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
			"targets": [0, 4],
			"orderable": false,
		}, ],
	});


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
						url: "blocked.php",
						type: 'POST',
						data: {
							id: id
						},
						success: function () {
							swal(
									'Berhasil!',
									'Member berhasil diblokir!',
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