$(document).ready(function () {
    $("#registrationForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "validate.php",
            data: $(this).serialize(),
            success: function (response) {
                if (response === "success") {
                    // Send an email using smtp.js
                    var email = $("#email").val();
                    var name = $("#name").val();
                    Email.send({
                        SecureToken: "125cca7f-c2cc-4ea1-9d5e-f4de5b721c34",
                        To: email,
                        From: "manilalouisangel2@gmail.com",
                        Subject: "Thank you for registering!",
                        Body: "Dear " + name + ",\n\nThank you for registering on our website. We appreciate your participation!"
                    }).then(
                        function () {
                            // pass post values to thank_you.php to display name and email
                            var form = $('<form action="thank_you.php" method="post">' +
                                '<input type="hidden" name="name" value="' + name + '">' +
                                '<input type="hidden" name="email" value="' + email + '">' +
                                '</form>');
                            $('body').append(form);
                            form.submit();
                        },
                        function (error) {
                            console.error('Error sending email: ', error);
                        }
                    );
                } else {
                    // Display error messages if there are any
                    $("#error-message").html(response);
                }
            }
        });
    });
});