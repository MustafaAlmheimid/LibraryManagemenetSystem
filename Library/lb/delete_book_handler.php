<?php
// delete_book_handler.php

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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        $userId = $_COOKIE['userId'];
        $bookId = $_POST['bookId'];

        // Delete related records in the borrowing table
        $deleteBorrowingQuery = "DELETE FROM borrowing WHERE isbn = '$bookId'";
        $resultBorrowing = $conn->query($deleteBorrowingQuery);

        if (!$resultBorrowing) {
            die("Error in SQL query for deleting borrowing records: " . $conn->error);
        }

        // Now, delete the book from the books table
        $deleteBookQuery = "DELETE FROM books WHERE isbn = '$bookId'";
        $resultBooks = $conn->query($deleteBookQuery);

        if (!$resultBooks) {
            die("Error in SQL query for deleting book: " . $conn->error);
        } else {
            // Additional success message
            echo "<script>alert('Book deleted successfully.');</script>";
        }

        // Redirect back to delete_book.php after deletion
        header("Location: delete_book.php");
        exit();
    }
} else {
    // User is not logged in, redirect to the login page
    header("Location: LogIn/loginn.php");
    exit();
}

$conn->close();
?>
