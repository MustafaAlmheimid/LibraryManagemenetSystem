<!-- process_review.php -->

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include('./dbconnection.php');
    $conn = connectServer('localhost', 'root', '', 1);
    selectDB($conn, 'librarydb1', 1);
    // Get form data
    $isbn = $_POST['isbn'];
    $userId = $_POST['userId'];
    $ratingValue = $_POST['rating'];
    $description = $_POST['review'];

    // Insert the review into the database
    $sql = "INSERT INTO rating (userId, isbn, ratingValue, review) 
            VALUES ('$userId', '$isbn', '$ratingValue', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: book_details.php?isbn=".$isbn);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect if the form is not submitted
    header("Location: book_review.php");
    exit();
}
?>
