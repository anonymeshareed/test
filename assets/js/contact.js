/*
*
* Contact JS
* @ThemeEaster
*/
$(function() {
    // Get the form.
    var form = $('#ajax_contact');

    // Get the messages div.
    var formMessages = $('#form-messages');

    // Set up an event listener for the contact form.
	$(form).submit(function(event) {
		// Stop the browser from submitting the form.
		event.preventDefault();

		// Serialize the form data.
		var formData = $(form).serialize();
		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			// Parse JSON response
			var result = typeof response === 'string' ? JSON.parse(response) : response;
			
			// Show messages div
			$(formMessages).show();
			
			// Make sure that the formMessages div has the correct class.
			if (result.success) {
				$(formMessages).removeClass('alert-danger');
				$(formMessages).addClass('alert-success');
				$(formMessages).text(result.message || 'Messaggio inviato con successo!');
				
				// Clear the form.
				$('#first-name').val('');
				$('#e-mail').val('');
				$('#phone').val('');
				$('#country').val('');
				$('#profession').val('');
				$('#income').val('');
				$('#address').val('');
				$('#subject').val('');
				$('#comments').val('');
			} else {
				$(formMessages).removeClass('alert-success');
				$(formMessages).addClass('alert-danger');
				$(formMessages).text(result.message || 'Errore nell\'invio del messaggio.');
			}
		})
		.fail(function(data) {
			// Show messages div
			$(formMessages).show();
			
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('alert-success');
			$(formMessages).addClass('alert-danger');

			// Set the message text.
			var errorMsg = 'Errore nell\'invio del messaggio. Riprova più tardi.';
			try {
				var errorResponse = typeof data.responseJSON !== 'undefined' ? data.responseJSON : JSON.parse(data.responseText);
				if (errorResponse.message) {
					errorMsg = errorResponse.message;
				}
			} catch(e) {
				if (data.responseText !== '') {
					errorMsg = data.responseText;
				}
			}
			$(formMessages).text(errorMsg);
		});

	});

});