<?php
// remove_book.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in using cookies
if (isset($_COOKIE['userId']) && isset($_COOKIE['userEmail'])) {
    $userId = $_COOKIE['userId'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
        $bookId = $_POST['bookId'];

        // Remove the book from the reservation table
        $removeBook = "DELETE FROM reservation WHERE userId = '$userId' AND isbn = '$bookId'";
        if ($conn->query($removeBook) === TRUE) {
            echo "<script>alert('Book removed from the cart successfully.')</script>";
        } else {
            echo "Error: " . $removeBook . "<br>" . $conn->error;
        }

        // You may want to perform additional cleanup or actions here
    }

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
} else {
    // User is not logged in, redirect to the login page
    header("Location: LogIn/loginn.php");
    exit();
}

$conn->close();
?>
