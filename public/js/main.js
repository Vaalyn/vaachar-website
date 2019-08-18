$(document).ready(function() {
	M.AutoInit();
	M.Modal.init(document.querySelectorAll('.produkte .buy-now-modal'), {
		dismissible: false
	});

	$('a[href*=\\#]').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $(this.hash).offset().top - 100
		}, 500);
	});

	$('.produkte .buy-now-modal form').on('submit', function(e) {
		e.preventDefault();

		let form = $(this);
		let postFormData = new FormData($(this)[0]);

		$(form).find('.modal-content').hide();
		$(form).find('.modal-footer').hide();
		$(form).find('.buy-now-loader').removeClass('hide');

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: postFormData,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
				$(form).find('.buy-now-loader').addClass('hide');
				$(form).find('.modal-content').show();
				$(form).find('.modal-footer').show();

				if (data.status === 'error') {
					M.toast({
						html: '<i class="material-icons red-text text-darken-1">error_outline</i> ' + data.message,
						displayLength: 3000
					});
					return;
				}

				$(form).closest('.modal').modal('close');
				$(form)[0].reset();

				window.location.href = data.redirect_url;
			}
		});

		return false;
	});
});
