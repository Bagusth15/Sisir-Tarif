$('.tombol-hapus').on('click', function(e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "data akan dihapus",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Data!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});

$('#select_all').on('click', function() {
	if (this.checked) {
		$('.check').each(function() {
			this.checked = true;
		})
	} else {
		$('.check').each(function() {
			this.checked = false;
		})
	}
});

$('.check').on('click', function() {
	if ($('.check:checked').length == $('.check').length) {
		$('#select_all').prop('checked', true)
	} else {
		$('#select_all').prop('checked', false)
	}
});


// $("#messageDropdown").click(function() {                

//       $.ajax({    //create an ajax request to display.php
//         type: "GET",
//         url: "ajax/notif.php",             
//         dataType: "html",   //expect html to be returned                
//         success: function(response){                    
//             $("#responsenotif").html(response); 
//             //alert(response);
//         }

//     });
// });

