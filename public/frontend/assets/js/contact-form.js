(function ($, window, document, undefined) {
    'use strict';

    var $form = $('#contact-form');

    $form.submit(function (e) {
        e.preventDefault();

        // remove the error class
        $('.form-box').removeClass('has-error');
        $('.help-block').remove();

        // get the form data
        var formData = {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            subject: $('input[name="subject"]').val(),
            message: $('textarea[name="message"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
        };

        // process the form
        $.ajax({
            type: 'POST',
            url: "{{ route('contact') }}", // Laravel route
            data: formData,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                if (data.errors.name) {
                    $('#form-name').parent('.form-box').addClass('has-error')
                        .append('<div class="help-block">' + data.errors.name + '</div>');
                }
                if (data.errors.email) {
                    $('#form-email').parent('.form-box').addClass('has-error')
                        .append('<div class="help-block">' + data.errors.email + '</div>');
                }
                if (data.errors.subject) {
                    $('#form-subject').parent('.form-box').addClass('has-error')
                        .append('<div class="help-block">' + data.errors.subject + '</div>');
                }
                if (data.errors.message) {
                    $('#form-message').parent('.form-box').addClass('has-error')
                        .append('<div class="help-block">' + data.errors.message + '</div>');
                }
            } else {
                // display success message
                $form.html('<div class="alert alert-success">' + data.message + '</div>');
            }
        }).fail(function (xhr) {
            console.log(xhr.responseText);
        });
    });
}(jQuery, window, document));
