<?php
include('./dbconnection.php');
session_start();

// Initialize error variable
$err = 0;

// Use the connectServer function from dbconnection.php to establish a connection
$dbc = connectServer('localhost', 'root', '', 1);

// Use the selectDB function from dbconnection.php to select the database
selectDB($dbc, 'librarydb1', 1);

if (isset($_POST['submit'])) {
    // ... (your existing code to retrieve form data)
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $email_error = "Please enter your email";
        $err = 1;
    }
    if (empty($password)) {
        $password_error = "Please enter your password";
        $err = 1;
        include("loginn.php");
    }

    if ($err == 0) {
        // Perform the query with proper password handling
        $query = "SELECT userId, email, firstname, lastname, password , role FROM users WHERE email = '$email'";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user && password_verify($password, $user['password'])) {
                $userId = $user['userId'];
                $userEmail = $user['email'];
                $firstName = $user['firstname'];
                $lastName = $user['lastname'];
                $role = $user['role'];
                echo "Authentication successful";

                // Store non-sensitive user information in cookies
                setcookie('userId', $userId, time() + 60 * 60 * 24, '/');
                setcookie('userEmail', $userEmail, time() + 60 * 60 * 24, '/');
                setcookie('firstName', $firstName, time() + 60 * 60 * 24, '/');
                setcookie('lastName', $lastName, time() + 60 * 60 * 24, '/');
                setcookie('role', $role, time() + 60 * 60 * 24, '/');

                // Redirect to the projet.php page
                header("Location: /projet.php");
                exit();
            } else {
                $error = "Invalid email or password. Please try again.";
            }
        } else {
            $error = "Error executing the query.";
        }
    }
}

// Display error message if any
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}

// Close the database connection
$dbc->close();
