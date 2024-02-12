<?php
// cart.php

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

    // Fetch reserved books from the reservation table
    $getReservedBooks = "SELECT r.isbn, b.title, r.reservationDate, r.expireDate
                         FROM reservation r
                         JOIN books b ON r.isbn = b.isbn
                         WHERE r.userId = '$userId'";
    $result = $conn->query($getReservedBooks);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ReadersHome - Cart</title>

        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />

        <!-- Include jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <!-- Include your existing styles and scripts here -->
        <style>
            /* Add your custom styles here */
        </style>
    </head>

    <body>
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Cart<?php
                    if ($result->num_rows > 0) {
                        echo ' (' . $result->num_rows . ' books)';
                    }
                    ?></h1>
                <button onclick="goBack()" class="btn btn-primary">Go Back</button>
            </div>

            <?php
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead>
                        <tr>
                            <th>Title</th>
                            <th>Reservation Date</th>
                            <th>Expire Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    // Make the book title clickable with a link to book_details.php
                    echo '<td><a href="book_details.php?isbn=' . $row['isbn'] . '">' . $row['title'] . '</a></td>';
                    echo '<td>' . $row['reservationDate'] . '</td>';
                    echo '<td>' . $row['expireDate'] . '</td>';
                    // Add a form for removing the book
                    echo '<td>';
                    echo '<form method="post" action="remove_book.php">';
                    echo '<input type="hidden" name="bookId" value="' . $row['isbn'] . '">';
                    echo '<button type="submit" class="btn btn-danger" name="remove">Remove</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No books in the cart.</p>';
            }
            ?>
        </div>

        <!-- ... (existing scripts and closing HTML tags) ... -->
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </body>

    </html>

    <?php
} else {
    // User is not logged in, redirect to the login page
    header("Location: LogIn/loginn.php");
    exit();
}

$conn->close();
?>
