$(function() {
	$('.subscribe-button').on('click', function(e) {
		e.preventDefault();

		var status = $(this).attr('data-status');

//		if (true) {
			if (parseInt(status)) {
				$(this)
					.attr('data-status', 0)
					.removeClass('btn-success')
					.addClass('btn-default')
					.find('span')
					.text('Subscribe');

				$(this)
					.find('.glyphicon')
					.addClass('hide');
			} else {
				$(this)
					.attr('data-status', 1)
					.removeClass('btn-default')
					.addClass('btn-success')
					.find('span')
					.text('Subscribed')
				;

				$(this)
					.find('.glyphicon')
					.removeClass('hide');
			}
//		}
	})
});
