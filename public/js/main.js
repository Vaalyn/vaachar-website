$(document).ready(function() {
	M.AutoInit();

	$('a[href*=\\#]').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $(this.hash).offset().top - 100
		}, 500);
	});
});
