<?php
    // Assuming you have a database connection established
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

        include('checkReservesBooks.php');
        if (checkBorrowingLimit($userId)) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['reserve'])) {
                    $bookId = $_POST['bookId'];

                    // Check if the book is available
                    $checkAvailability = "SELECT * FROM books WHERE isbn = $bookId AND isAvailable = 1";
                    $result = $conn->query($checkAvailability);

                    if ($result->num_rows > 0) {
                        // Book is available, proceed with reservation

                        // Check if the same user has already reserved the book
                        $checkUserReservation = "SELECT * FROM reservation WHERE userId = '$userId' AND isbn = $bookId";
                        $userReservationResult = $conn->query($checkUserReservation);

                        if ($userReservationResult->num_rows === 0) {
                            // Retrieve book details from the 'books' table
                            $getBookDetails = "SELECT title FROM books WHERE isbn = $bookId";
                            $bookDetailsResult = $conn->query($getBookDetails);

                            if ($bookDetailsResult->num_rows > 0) {
                                $bookDetails = $bookDetailsResult->fetch_assoc();
                                $bookTitle = $bookDetails['title'];

                                // Insert reservation details into the 'reservation' table
                                $reserveBook = "INSERT IGNORE INTO reservation (userId, isbn, reservationDate, expireDate) VALUES ('$userId', '$bookId', NOW(), DATE_ADD(NOW(), INTERVAL 14 DAY))";

                                if ($conn->query($reserveBook) === TRUE) {
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

                                    echo "<script>alert('Book reserved successfully!')</script>";
                                } else {
                                    echo "Error: " . $reserveBook . "<br>" . $conn->error;
                                }
                            } else {
                                echo "Error: Unable to retrieve book details. <br>" . $conn->error;
                            }
                        } else {
                            echo "<script>alert('Sorry, you have already reserved this book.')</script>";
                        }
                    } else {
                        // Book is not available
                        echo "<script>alert('This book is not available.')</script>";
                    }
                }
            }
        } else {
            // User has reached the borrowing limit
            echo "<script>alert('You have reached the borrowing limit.')</script>";
        }
    } else {
        // User is not logged in, redirect to the login page
        header("Location: LogIn/loginn.php");
        exit();
    }
    
    $conn->close();
    ?>
