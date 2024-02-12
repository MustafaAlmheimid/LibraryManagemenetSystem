<?php
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
    $userEmail = $_COOKIE['userEmail'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form is submitted for reservation
        if (isset($_POST['reserve'])) {
            $bookId = $_POST['bookId'];

            // Validate book ID
            if (!isset($bookId) || !is_numeric($bookId)) {
                echo json_encode(array("status" => "error", "message" => "Invalid book ID."));
                exit();
            }

            // Check if the book is available
            $checkAvailability = "SELECT * FROM books WHERE isbn = $bookId AND isAvailable = 1";
            $result = $conn->query($checkAvailability);

            if ($result->num_rows > 0) {
                // Book is available, proceed with reservation

                // Check if the same user has already reserved the book
                $checkUserReservation = "SELECT * FROM reservation WHERE userId = '$userId' AND isbn = $bookId";
                $userReservationResult = $conn->query($checkUserReservation);

                if ($userReservationResult->num_rows === 0) {
                    $reserveBook = "INSERT IGNORE INTO reservation (userId, isbn, reservationDate, expireDate) VALUES ('$userId', '$bookId', NOW(), DATE_ADD(NOW(), INTERVAL 14 DAY))";

                    if ($conn->query($reserveBook) === TRUE) {
                        // Insert the reserved book into the cart
                        $insertIntoCart = "INSERT INTO cart (userId, bookId, reservationDate, expireDate) VALUES ('$userId', '$bookId', NOW(), DATE_ADD(NOW(), INTERVAL 14 DAY))";
                        if ($conn->query($insertIntoCart) === TRUE) {
                            // Update the number of copies in the books table
                            $updateCopies = "UPDATE books SET nbOfCopies = nbOfCopies - 1 WHERE isbn = $bookId";
                            $conn->query($updateCopies);

                            // Check if the number of copies is now zero or less
                            $checkCopies = "SELECT nbOfCopies FROM books WHERE isbn = $bookId";
                            $copiesResult = $conn->query($checkCopies);

                            if ($copiesResult->num_rows > 0) {
                                $row = $copiesResult->fetch_assoc();
                                $nbOfCopies = intval($row['nbOfCopies']);
                                if ($nbOfCopies <= 0) {
                                    // Update the availability status in the books table
                                    $updateAvailability = "UPDATE books SET isAvailable = 0 WHERE isbn = $bookId";
                                    $conn->query($updateAvailability);
                                }
                            }

                            echo json_encode(array("status" => "success", "message" => "Book reserved successfully and added to the cart!"));
                        } else {
                            echo json_encode(array("status" => "error", "message" => "Error adding book to the cart."));
                        }
                    } else {
                        echo json_encode(array("status" => "error", "message" => "Error reserving book."));
                    }
                } else {
                    echo json_encode(array("status" => "error", "message" => "Sorry, you have already reserved this book."));
                }
            } else {
                // Book is not available
                echo json_encode(array("status" => "error", "message" => "This book is not available."));
            }
        }
    }
} else {
    // User is not logged in, redirect to the login page
    echo json_encode(array("status" => "error", "message" => "User not logged in."));
}

$conn->close();
?>
