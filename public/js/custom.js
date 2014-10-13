$(function() {
	var list = simpleStorage.index(),
		subscribeButton = $('.subscribe-button'),
		approveButton = $('.approve-button');

	subscribeButton.on('custom', function(e, state) {
		var status = $(this).attr('data-status'),
			alias = $(this).attr('data-alias'),
			version = $(this).attr('data-version');

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

			if (state) {
				simpleStorage.deleteKey(alias);
			}
		} else {
			$(this)
				.attr('data-status', 1)
				.removeClass('btn-default')
				.addClass('btn-success')
				.find('span')
				.text('Subscribed');

			$(this)
				.find('.glyphicon')
				.removeClass('hide');


			if (state) {
				simpleStorage.set(alias, version);
			}
		}
	});

	subscribeButton.on('click', function(e) {
		e.preventDefault();

		$(this).trigger('custom', [true]);
	});

	approveButton.on('click', function(e) {
		e.preventDefault();

		var self = $(this),
			parent = self.parent(),
			alias = $(this).attr('data-alias'),
			version = $(this).attr('data-version');

		simpleStorage.set(alias, version);

		setTimeout(function() {
			parent.removeClass('strong');
			self.hide('fast', function() {
				parent.find('.old-version').hide()
			});
		}, 500);
	});

	if (list.length) {
		subscribeButton.each(function() {
			var self = $(this);

			for (var index in list) {
				if (list.hasOwnProperty(index)) {
					if (self.attr('data-alias') == list[index]) {
						var parent = self.parent(),
							oldVersion = simpleStorage.get(list[index]);

						self.trigger('custom', [false]);

						if (self.attr('data-version') != oldVersion) {
							parent
								.addClass('strong')
								.find('.approve-button').removeClass('hide');

							parent.find('.old-version').text(oldVersion);
						}
					}
				}
			}
		});
	}
});
