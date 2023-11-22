<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
    <?php
        $name = isset($_POST["name"]) ? $_POST["name"] : "User";
        $email = isset($_POST["email"]) ? $_POST["email"] : "your email";
        echo "<p>Thank you, $name, for registering!<br>We have sent an email to $email for confirmation (The email will be in the spam folder as it uses elasticemail and it requires the email sender to be paid premium but this is just for assessment purposes.).</p>";
    ?>
</body>
</html>