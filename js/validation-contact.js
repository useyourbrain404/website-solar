$(document).ready(function() {
    $('#send_message').click(function(e) {
        e.preventDefault();
        
        var error = false;
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var message = $('#message').val();
        
        $('#name,#email,#phone,#message').click(function() {
            $(this).removeClass("error_input");
        });
        
        if (name.length == 0) {
            var error = true;
            $('#name').addClass("error_input");
        } else {
            $('#name').removeClass("error_input");
        }
        
        if (email.length == 0 || email.indexOf('@') == '-1') {
            var error = true;
            $('#email').addClass("error_input");
        } else {
            $('#email').removeClass("error_input");
        }
        
        if (phone.length == 0) {
            var error = true;
            $('#phone').addClass("error_input");
        } else {
            $('#phone').removeClass("error_input");
        }
        
        if (message.length == 0) {
            var error = true;
            $('#message').addClass("error_input");
        } else {
            $('#message').removeClass("error_input");
        }
        
        if (error == false) {
            $('#send_message').prop('disabled', true).val('Sending...');
            $('#send_message span').text('Sending Inquiry...');
            
            $.post("contact.php", $("#contact_form").serialize(), function(result) {
                if (result == 'sent' || result.indexOf('success') !== -1 || result.indexOf('ok') !== -1 || result.indexOf('sent') !== -1) {
                    $('#contact_form')[0].reset();
                    $('#submit').hide();
                    $('#error_message').hide();
                    $('#success_message').fadeIn(400);

                    // Automatic refresh after 2 seconds
                    setTimeout(function() {
                        window.location.href = "contact.php?sent=1";
                    }, 2000);
                } else {
                    $('#error_message').fadeIn(500);
                    $('#send_message').prop('disabled', false).val('Send Message');
                    $('#send_message span').text('Send Message & Request Quote');
                }
            }).fail(function() {
                $('#success_message').hide();
                $('#error_message').fadeIn(500);
                $('#send_message').prop('disabled', false).val('Send Message');
                $('#send_message span').text('Send Message & Request Quote');
            });
        }
    });

    // Smooth scroll to Thank You alert if page just refreshed
    if (window.location.search.indexOf('sent=1') !== -1) {
        if ($('#refresh_success').length) {
            $('html, body').animate({
                scrollTop: $('#refresh_success').offset().top - 140
            }, 500);
            setTimeout(function() {
                $('#refresh_success').fadeOut(800);
            }, 9000);
        }
    }
});
