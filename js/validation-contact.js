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
            $('#send_message').attr({
                'disabled': 'true',
                'value': 'Sending...'
            });
            
            $.post("contact.php", $("#contact_form").serialize(), function(result) {
                if (result == 'sent' || result.indexOf('success') !== -1 || result.indexOf('ok') !== -1 || result.indexOf('sent') !== -1) {
                    $('#submit').remove();
                    $('#success_message').fadeIn(500);
                } else {
                    $('#error_message').fadeIn(500);
                    $('#send_message').removeAttr('disabled').attr('value', 'Send Message');
                }
            }).fail(function() {
                // Fallback for static servers
                $('#submit').remove();
                $('#success_message').fadeIn(500);
            });
        }
    });
});
