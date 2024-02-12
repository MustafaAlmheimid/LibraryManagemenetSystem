<?php
// users_list.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb1"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in using cookies
if (isset($_COOKIE['userId']) && isset($_COOKIE['userEmail'])) {
    // Fetch admins and users from the users table
    $getAdminsQuery = "SELECT * FROM users WHERE role = 'admin'";
    $getUsersQuery = "SELECT * FROM users WHERE role = 'user'";

    $adminsResult = $conn->query($getAdminsQuery);
    $usersResult = $conn->query($getUsersQuery);

    if (!$adminsResult || !$usersResult) {
        die("Error in SQL query: " . $conn->error);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User List</title>

        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 20px;
            }

            .user-list {
                list-style: none;
                padding: 0;
            }

            .user-list li {
                margin-bottom: 10px;
                padding: 10px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .admins-section,
            .users-section {
                width: 48%;
                float: left;
                margin-right: 2%;
            }

            .go-back {
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="go-back">
                <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
            </div>

            <div class="admins-section">
                <h2>Admins</h2>
                <ul class="user-list">
                    <?php
                    if ($adminsResult->num_rows > 0) {
                        while ($row = $adminsResult->fetch_assoc()) {
                            echo '<li>' . $row['firstName'] . ' ' . $row['lastName'] . ' (Admin)</li>';
                        }
                    } else {
                        echo '<p>No admins found.</p>';
                    }
                    ?>
                </ul>
            </div>

            <div class="users-section">
                <h2>Users</h2>
                <ul class="user-list">
                    <?php
                    if ($usersResult->num_rows > 0) {
                        while ($row = $usersResult->fetch_assoc()) {
                            echo '<li>' . $row['firstName'] . ' ' . $row['lastName'] . ' (User)</li>';
                        }
                    } else {
                        echo '<p>No users found.</p>';
                    }
                    ?>
                </ul>
            </div>
        </div>

        <!-- ... (existing scripts and closing HTML tags) ... -->
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
