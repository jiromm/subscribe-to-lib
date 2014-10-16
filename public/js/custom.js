$(function() {
	var subscriptionEmail = 'subscription-email',
		list = simpleStorage.index(),
		subscribeSection = $('#subscribe'),
		alreadySubscribedSection = $('#already-subscribed'),
		bigSubscribeButton = $('.big-subscribe-button'),
		subscribeButton = $('.subscribe-button'),
		emailField = $('.email-input'),
		approveButton = $('.approve-button'),
		validateEmail = function(emailAddress) {
			return (
				new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i)
			).test(emailAddress);
		};

	subscribeButton.on('init', function(e, realClick) {
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

			if (realClick) {
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

			if (realClick) {
				simpleStorage.set(alias, version);
			}
		}

		if (realClick) {
			var email = simpleStorage.get(subscriptionEmail),
				data = {
					email: email,
					channel: alias,
					version: version,
					status: parseInt(status) ? 0 : 1
				};

			$.ajax({
				url: 'subscribe.php',
				type: 'POST',
				cache: false,
				data: JSON.stringify(data),
				dataType: 'json',
				contentType: 'application/json; charset=UTF-8',
				success: function(result) {
					if (result.status == 'success') {
						simpleStorage.set(subscriptionEmail, email);
						$(document).trigger('subscribed');

						subscribeSection.fadeOut('slow', function() {
							alreadySubscribedSection.show();
						});
					} else {
						alert('Server problems. Try later!')
					}
				}
			});
		}
	});

	subscribeButton.on('click', function(e) {
		e.preventDefault();

		$(this).trigger('init', [true]);
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
					if (list[index] == subscriptionEmail) {
						continue;
					}

					if (self.attr('data-alias') == list[index]) {
						var parent = self.parent(),
							oldVersion = simpleStorage.get(list[index]);

						self.trigger('init', [false]);

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

	emailField.on('change, keyup', function() {
		var self = $(this),
			parent = self.parent(),
			icon = parent.find('.form-control-feedback');

		if (validateEmail(self.val())) {
			parent.removeClass('has-error');
			icon.addClass('hide');
		} else {
			parent.addClass('has-error');
			icon.removeClass('hide');
		}
	});

	bigSubscribeButton.on('click', function(e) {
		e.preventDefault();

		var email = emailField.val(),
			channels = {},
			list = simpleStorage.index(),
			data = {
				email: email,
				channels: channels
			};

		if (list.length) {
			for (var index in list) {
				if (list.hasOwnProperty(index)) {
					channels[list[index]] = simpleStorage.get(list[index]);
				}
			}
		}

		if (validateEmail(email)) {
			$.ajax({
				url: 'subscribe.php',
				type: 'POST',
				cache: false,
				data: JSON.stringify(data),
				dataType: 'json',
				contentType: 'application/json; charset=UTF-8',
				success: function(result) {
					if (result.status == 'success') {
						simpleStorage.set(subscriptionEmail, email);
						$(document).trigger('subscribed');

						subscribeSection.fadeOut('slow', function() {
							alreadySubscribedSection.show();
						});
					} else {
						alert('Server problems. Try later!')
					}
				}
			});
		} else {
			emailField.focus();
		}
	});

	$(document).on('subscribed', function() {
		subscribeSection.hide();
		alreadySubscribedSection.show();

		$('.subscription-email').text(simpleStorage.get(subscriptionEmail));
	});

	$(document).on('unsubscribed', function() {
		subscribeSection.show();
		alreadySubscribedSection.hide();
	});

	if (simpleStorage.get(subscriptionEmail) == undefined) {
		$(document).trigger('unsubscribed');
	} else {
		$(document).trigger('subscribed');
	}
});


