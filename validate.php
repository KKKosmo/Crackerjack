<?php
require_once('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbConnector = new DatabaseConnector();
    $conn = $dbConnector->connect();

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $checkQuery = "SELECT username, email FROM users WHERE username = ? OR email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    $errors = [];

    if ($checkResult->num_rows > 0) {
        while ($row = $checkResult->fetch_assoc()) {
            if ($row['username'] === $username) {
                $errors[] = 'The username you have entered has already been registered with our system. Please enter a different username.';
            }
    
            if ($row['email'] === $email) {
                $errors[] = 'The email address you have entered is already registered with our system. Please enter a different email address.';
            }
        }
    }

    $checkStmt->close();

    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $errors[] = 'A valid email is required.';
    }

    $telephone = trim($_POST['telephone']);
    if (!preg_match('/^[0-9+]+$/', $telephone)) {
        $errors[] = 'Telephone must contain only numeric characters and the plus sign.';
    }
    

    // if any validations for these
    // $address1 = trim($_POST['address1']);
    // $address2 = trim($_POST['address2']);
    // $city = trim($_POST['city']);
    // $state = trim($_POST['state']);


    $zip = trim($_POST['zip']);
    if (empty($zip)) {
        $errors[] = 'Zip code is required.';
    }
    elseif (!preg_match('/^\d+$/', $zip)) {
        $errors[] = 'Zip code must contain only numeric characters.';
    }    

    if (empty($username)) {
        $errors[] = 'Username is required.';
    }

    if (strlen($username) < 3 || strlen($username) > 20) {
        $errors[] = 'Username must be between 3 and 20 characters.';
    }
    
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($password)) {
        $errors[] = 'Password is required.';
    }

    if (strlen($password) < 6 || strlen($password) > 20) {
        $errors[] = 'Password must be between 6 and 20 characters.';
    }


    // extra password validation
    // if (!preg_match('/[A-Z]/', $password)) {
    //     $errors[] = 'Password must contain at least one uppercase letter.';
    // }

    // if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
    //     $errors[] = 'Password must contain at least one special character.';
    // }

    
    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    // If there are validation errors, return them
    if (!empty($errors)) {
        echo implode('<br><br>', $errors);
        exit();
    }

    // Insert data into the database
    $name = $conn->real_escape_string(trim($_POST['name']));
    $telephone = $conn->real_escape_string(trim($_POST['telephone']));
    $address1 = $conn->real_escape_string(trim($_POST['address1']));
    $address2 = $conn->real_escape_string(trim($_POST['address2']));
    $city = $conn->real_escape_string(trim($_POST['city']));
    $state = $conn->real_escape_string(trim($_POST['state']));
    $zip = $conn->real_escape_string(trim($_POST['zip']));
    $password = sha1($_POST['password']);

    $insertQuery = "INSERT INTO users (name, email, telephone, address1, address2, city, state_province, zip_postcode, username, password) VALUES ('$name', '$email', '$telephone', '$address1', '$address2', '$city', '$state', '$zip', '$username', '$password')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    $conn->close();
}
?>