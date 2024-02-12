<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warning Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .book-row {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .green {
            color: green;
        }

        .gray {
            color: gray;
        }

        .red {
            color: red;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    // Replace the following with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "librarydb1";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Handle delete action
    if (isset($_POST['delete'])) {
        $isbnToDelete = $_POST['delete'];
        // Add logic to delete the reservation and increase available copies in the books table
        $deleteSql = "DELETE FROM reservation WHERE isbn = '$isbnToDelete'";
        $conn->query($deleteSql);

        // Add logic to increase available copies in the books table
        $increaseCopiesSql = "UPDATE books SET nbOfCopies = nbOfCopies + 1 WHERE isbn = '$isbnToDelete'";
        $conn->query($increaseCopiesSql);
    }

    // Fetch data from the reservation table with user information
    $sql = "SELECT reservation.*,users.firstName,users.lastName
        FROM reservation 
        JOIN users ON reservation.userId = users.userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $isbn  = $row['isbn']; // Assuming 'isbn' is the column representing book titles
            $userName = $row['firstName'] . " " . $row['lastName']; // Assuming 'userName' is the column representing user names
            $expireDate = strtotime($row['expireDate']);
            $currentDate = strtotime(date('Y-m-d'));

            $daysDifference = floor(($expireDate - $currentDate) / (60 * 60 * 24));

            if ($daysDifference > 5) {
                $status = 'green';
            } elseif ($daysDifference >= 1) {
                $status = 'gray';
            } else {
                $status = 'red';
            }
            // Handle borrow action
            if (isset($_POST['borrow'])) {
                $isbnToBorrow = $_POST['borrow'];
                // Add logic to insert into the borrowing table
                $insertBorrowingSql = "INSERT INTO borrowing (userId, isbn, dateFrom, dateTo) 
                                   SELECT userId, isbn, CURRENT_DATE, CURRENT_DATE + INTERVAL 7 DAY 
                                   FROM reservation 
                                   WHERE isbn = '$isbnToBorrow'";
                $conn->query($insertBorrowingSql);

                // Add logic to delete the reservation and increase available copies in the books table
                $deleteSql = "DELETE FROM reservation WHERE isbn = '$isbnToBorrow'";
                $conn->query($deleteSql);

                // Add logic to increase available copies in the books table
                $increaseCopiesSql = "UPDATE books SET nbOfCopies = nbOfCopies + 1 WHERE isbn = '$isbnToBorrow'";
                $conn->query($increaseCopiesSql);
            }


 /*           if (isset($_POST['borrow'])) {
                $isbnToBorrow = $_POST['borrow'];
            
                try {
                    // Start a transaction
                    $conn->begin_transaction();
            
                    // Insert into the borrowing table
                    $insertBorrowingSql = "INSERT INTO borrowing (userId, isbn, dateFrom, dateTo) 
                                           SELECT userId, isbn, CURRENT_DATE, CURRENT_DATE + INTERVAL 7 DAY 
                                           FROM reservation 
                                           WHERE isbn = ?";
                    $insertBorrowingStmt = $conn->prepare($insertBorrowingSql);
                    $insertBorrowingStmt->bind_param("s", $isbnToBorrow);
                    $insertBorrowingStmt->execute();
                    $insertBorrowingStmt->close();
            
                    // Delete from the reservation table
                    $deleteSql = "DELETE FROM reservation WHERE isbn = ?";
                    $deleteStmt = $conn->prepare($deleteSql);
                    $deleteStmt->bind_param("s", $isbnToBorrow);
                    $deleteStmt->execute();
                    $deleteStmt->close();
            
                    // Increase available copies in the books table
                    $increaseCopiesSql = "UPDATE books SET nbOfCopies = nbOfCopies + 1 WHERE isbn = ?";
                    $increaseCopiesStmt = $conn->prepare($increaseCopiesSql);
                    $increaseCopiesStmt->bind_param("s", $isbnToBorrow);
                    $increaseCopiesStmt->execute();
                    $increaseCopiesStmt->close();
            
                    // Commit the transaction
                    $conn->commit();
            
                    echo "Borrowing transaction successful.";
                } catch (Exception $e) {
                    // Rollback the transaction in case of an error
                    $conn->rollback();
                    echo "Error: " . $e->getMessage();
                }
            }
*/            

            echo "<div class='book-row $status'>";
            echo "<span>Book: $isbn</span>";
            echo "<span>User: $userName</span>";
            echo "<span>Status: $status</span>";
            echo "<span>Days Left: $daysDifference</span>";
            // Add the delete button
            echo "<form method='post'>";
            echo "<input type='hidden' name='delete' value='$isbn'>";
            echo "<button type='submit' class='delete-btn'>reject</button>";
            echo "</form>";
              // Add the new button for borrowing
              echo "<form method='post' action='acceptReserve.php'>";
              echo "<input type='hidden' name='borrow' value='$isbn'>";
              echo "<button type='submit' class='borrow-btn'>accept</button>";
              echo "</form>";
            echo "</div>";
            echo "</div>";


          
        }
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
    ?>

</body>

</html>