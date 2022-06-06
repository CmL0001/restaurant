$ = jQuery.noConflict();

$(document).ready(function() {
	$('.remove_reservation').on('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-reservation');
		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type:'post',
					data : {
						'action': 'lapizzaria_delete_reservation',
						'id' : id,
						'type' : 'delete'
					},
					url: admin_ajax.ajaxurl,
					success: function(data) {
						var result = JSON.parse(data);
						if(result.response == 'success') {
							jQuery("[data-reservation='"+ result.id +"']").parent().parent().remove();
							swal(
							  'Reservation Deleted!',
							  'Success, the reservation was deleted!',
							  'success'
							)
						}
					}
				});
			}
		})	
	});
});