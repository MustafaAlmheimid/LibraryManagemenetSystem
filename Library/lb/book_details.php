<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Details</title>
        <style>
            body {
                font-family: 'Helvetica', sans-serif;
                background-color: #f0f0f0;
                padding: 20px;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .book-card-info {
                border: 1px solid #ddd;
                padding: 20px;
                text-align: center;
                border-radius: 8px;
                transition: transform 0.3s;
                position: relative;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                max-width: 800px;
                margin: 0 auto;
                background-color: #fff;
            }

            .book-card-info:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
            }

            .book-cover-info {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin-bottom: 20px;
            }

            .book-title-info {
                font-size: 28px;
                font-weight: bold;
                color: #333;
            }

            .book-author-info {
                color: #555;
                margin-bottom: 10px;
            }

            .book-description-info {
                text-align: left;
                line-height: 1.6;
            }

            .book-info-row {
                margin-bottom: 10px;
                font-size: 16px;
            }

            .reservation-button {
                display: inline-block;
                background-color: #004080;
                color: white;
                text-align: center;
                border-radius: 4px;
                padding: 12px 24px;
                margin-top: 20px;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s;
                font-size: 18px;
            }

            .reservation-button:hover {
                background-color: #45a049;
            }

            .reviews-section {
                margin-top: 20px;
            }

            .review {
                border: 1px solid #ddd;
                padding: 15px;
                margin-bottom: 15px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .rating {
                font-size: 20px;
                font-weight: bold;
                color: #f9b234;
            }

            .star {
                color: #f9b234;
            }

            .user-id {
                margin-top: 10px;
                color: #555;
                font-size: 16px;
            }

            .review-text {
                margin-top: 10px;
                line-height: 1.6;
            }
        </style>
    </head>

    <body>
        <h1>Book Details</h1>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the form is submitted for reservation
            if (isset($_POST['reserve'])) {
                $bookId = $_POST['bookId']; //==>isbn
                $userId = $_POST['userId']; //lmafroud ytekhad mn login ==>halla2 3m 2efterdou eftirad

                // Check if the user has already reserved three books==>(maximum reserved 3 books)
                $checkUserReservations = "SELECT COUNT(*) as count FROM reservation WHERE userId = '$userId'";
                $userReservationsResult = $conn->query($checkUserReservations);

                if ($userReservationsResult->num_rows > 0) {
                    $userReservationsCount = $userReservationsResult->fetch_assoc()['count'];

                    if ($userReservationsCount < 3) {
                        // Check if the book is available
                        $checkAvailability = "SELECT * FROM books WHERE isbn = $bookId AND isAvailable = 1 AND nbOfCopies > 0";
                        $result = $conn->query($checkAvailability);

                        if ($result->num_rows > 0) {
                            // Book is available, proceed with reservation

                            // Check if the same user has already reserved the book
                            $checkUserReservation = "SELECT * FROM reservation WHERE userId = '$userId' AND isbn = $bookId";
                            $userReservationResult = $conn->query($checkUserReservation);
                            if ($userReservationResult->num_rows === 0) {
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
                                echo "<script>alert('Sorry you are already reserved.')</script>";
                            }
                        } else {
                            // Book is not available
                            echo "<script>alert('This book is not available.')</script>";
                        }
                    } else {
                        echo "<script>alert('Im Sorry, you have reserved more than 3 books.')</script>";
                    }
                }
            }
        }

        // Get the ISBN from the URL
        $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';

        $sql = "SELECT * FROM books WHERE isbn = '$isbn'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Display book details
            echo "<div class='book-card-info'>";
            echo "<img class='book-cover-info' src='" . $row['cover'] . "' alt='Book Cover'>";
            echo "<div class='book-title-info'>" . $row['title'] . "</div>";
            echo "<div class='book-author-info'>" . $row['authorName'] . "</div>";
            echo "<div class='book-description-info'>";
            echo "<div class='book-info-row'><strong>ISBN:</strong> " . $row['isbn'] . "</div>";
            echo "<div class='book-info-row'><strong>Pages:</strong> " . $row['pagesNumber'] . "</div>";
            echo "<div class='book-info-row'><strong>Category:</strong> " . $row['category'] . "</div>";
            echo "<div class='book-info-row'><strong>Publication Date:</strong> " . $row['publicationDate'] . "</div>";
            echo "<div class='book-info-row'><strong>Language:</strong> " . $row['language'] . "</div>";
            echo "<div class='book-info-row'><strong>Publisher:</strong> " . $row['publisher'] . "</div>";

            if ($row['isAvailable'] == 1) {
                echo "<div class='book-info-row'><strong>Availability:</strong> Available</div>";
                echo "<form method='post' action='reserveBook.php'>";
                echo "<input type='hidden' name='bookId' value='" . $row['isbn'] . "'>";
                echo "<input type='hidden' name='userId' value='767'>"; // Replace with the actual user ID
                echo "<button type='submit' name='reserve' class='reservation-button'>Reserve</button>";
                echo "</form>";
            } else {
                echo "<div class='book-info-row'><strong>Availability:</strong> Not Available</div>";
            }

            echo "</div>";

            // Reviews section
            echo "<div class='reviews-section'>";
            echo "<h2>Reviews</h2>";

            // Get reviews for the book
            $getReviewsQuery = "SELECT * FROM rating WHERE isbn = '$isbn'";
            $reviewsResult = $conn->query($getReviewsQuery);

            if ($reviewsResult->num_rows > 0) {
                while ($review = $reviewsResult->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<div class='rating'>$review[ratingValue] <span class='star'>&#9733;</span></div>";
                    echo "<div class='user-id'>User ID: $review[userId]</div>";
                    echo "<div class='review-text'>$review[review]</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available for this book.</p>";
            }

            echo "</div>";
            echo "</div>";
        } else {
            echo "Book not found.";
        }

        $conn->close();
        ?>

        <!-- Add additional content as needed -->
    </body>

    </html>
