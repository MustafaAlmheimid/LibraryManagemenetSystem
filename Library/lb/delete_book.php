<?php
// delete_book.php

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

    // Fetch books owned by the user
    $getOwnedBooks = "SELECT * FROM books";
    $result = $conn->query($getOwnedBooks);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ReadersHome - Delete Books</title>

        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    </head>

    <body>
        <div class="container mt-5">
            <h1>Delete Books</h1>

            <?php
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['authorName'] . '</td>';
                    echo '<td>';
                    echo '<form method="post" action="delete_book_handler.php">';
                    echo '<input type="hidden" name="bookId" value="' . $row['isbn'] . '">';
                    echo '<button type="submit" class="btn btn-danger" name="delete">Delete</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No books found.</p>';
            }
            ?>
        </div>

        <!-- Include Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
