<?php
// borrowing_history.php

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

    // Fetch all borrowed books from the borrowing table
    $getBorrowedBooks = "SELECT b.isbn, b.title, br.dateFrom, br.dateTo
                         FROM borrowing br
                         JOIN books b ON br.isbn = b.isbn
                         WHERE br.userId = $userId
                         ORDER BY br.dateFrom DESC"; // Order by dateFrom descending
    $result = $conn->query($getBorrowedBooks);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Borrowing History</title>

        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />

        <!-- Include jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <!-- Include your existing styles and scripts here -->
        <style>
            /* Add your custom styles here */
            .expired {
                color: red;
            }

            .not-expired {
                color: green;
            }
        </style>
    </head>

    <body>
        <div class="container mt-5">
            <h1>Borrowing History</h1>

            <?php
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead>
                        <tr>
                            <th>Title</th>
                            <th>ISBN</th>
                            <th>Borrowed Date</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr class="' . (strtotime($row['dateTo']) < time() ? 'expired' : 'not-expired') . '">';
                    // Make the book title clickable with a link to book_details.php
                    echo '<td><a href="book_details.php?isbn=' . $row['isbn'] . '">' . $row['title'] . '</a></td>';
                    echo '<td>' . $row['isbn'] . '</td>';
                    echo '<td>' . $row['dateFrom'] . '</td>';
                    echo '<td>' . $row['dateTo'] . '</td>';
                    echo '<td>';
                    // Add a button to send notification if the date has passed
                    if (strtotime($row['dateTo']) < time()) {
                        echo '<button onclick="sendNotification(' . $userId . ', \'' . $userEmail . '\')">Send Notification</button>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No borrowing history available.</p>';
            }
            ?>
        </div>

        <script>
            function sendNotification(userId, userEmail) {
                // Implement the logic to check for a passed date and open the email client
                if (confirm('Send notification to ' + userEmail + '?')) {
                    // Define the subject and body of the email
                    var subject = 'Overdue Book Notification';
                    var body = 'Dear user,\n\nYour borrowed book is overdue. Please return it as soon as possible.';

                    // Construct the mailto URL
                    var mailtoURL = 'mailto:' + userEmail + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);

                    // Open the default email client
                    window.location.href = mailtoURL;
                }
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