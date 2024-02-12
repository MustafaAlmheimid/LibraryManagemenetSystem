<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $interests = $_POST['interests'];
    $password = $_POST['password'];
    $confpass = $_POST['confpass'];

    // Check if passwords match
    if ($password == $confpass) {
        // Passwords match, proceed with inserting into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the 'users' table
        $insertUserQuery = "INSERT INTO users (firstname, lastname, email, number, age, address, interests, password, role)
                            VALUES ('$firstname', '$lastname', '$email', '$number', '$age', '$address', '$interests', '$hashed_password', 'user')";

        if ($conn->query($insertUserQuery) === TRUE) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . $insertUserQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match.";
    }

    $conn->close();
}
?>
