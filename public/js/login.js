$(function() {
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            email: {
                required: "Please enter email",
                email: "Please enter valid email"
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 2 characters"
            }
        },

        submitHandler: function(form) {

            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json',

                success: function(response) {
                    console.log(response);

                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                        return;
                    }

                    alert(response.message || 'Login failed!');
                },

                error: function(error) {
                    console.error('Error:', error);
                    alert(error.responseJSON?.message || 'Login failed!');
                }
            });

            return false;
        }
    });
});
