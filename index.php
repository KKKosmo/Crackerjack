<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo filemtime('styles.css'); ?>">
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <title>Registration Page</title>
</head>
<body>
    <form id="registrationForm" method="post">
        <label for="name">*Name:</label>
        <input type="text" id="name" name="name">

        <label for="email">*Email:</label>
        <input type="text" id="email" name="email">

        <label for="telephone">Telephone:</label>
        <input type="text" id="telephone" name="telephone">

        <label for="address1">Address 1:</label>
        <input type="text" id="address1" name="address1">

        <label for="address2">Address 2:</label>
        <input type="text" id="address2" name="address2">

        <label for="city">City:</label>
        <input type="text" id="city" name="city">

        <label for="state">State/Province:</label>
        <input type="text" id="state" name="state">

        <label for="zip">*Zip/Post Code:</label>
        <input type="text" id="zip" name="zip">

        <label for="username">*Username:</label>
        <input type="text" id="username" name="username">

        <label for="password">*Password (6-20 characters):</label>
        <input type="password" id="password" name="password">

        <label for="confirmPassword">*Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword">

        <!-- gets any errors from ajax.js -->
        <p id="error-message"></p>

        <input type="submit" value="Register" id="registerButton">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="ajax.js"></script>
</body>
</html>