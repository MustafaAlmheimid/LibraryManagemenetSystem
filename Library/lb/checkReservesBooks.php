<?php

include('./dbconnection.php');
$dbc = connectServer('localhost', 'root', '', 1);
selectDB($dbc, 'librarydb1', 1);

function checkBorrowingLimit($userId)
{
    global $dbc; // Assuming $dbc is defined in dbconnection.php

    // Check how many times the user exists in the borrowing table
    $checkQuery = "SELECT COUNT(*) as borrowCount FROM borrowing WHERE userId = '$userId'";
    $result = mysqli_query($dbc, $checkQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $borrowCount = $row['borrowCount'];

        // Define the borrowing limit (4 times)
        $borrowingLimit = 3;

        // Compare with the borrowing limit
        if ($borrowCount >= $borrowingLimit) {
            // User has borrowed books more than or equal to the limit
            return false;
        } else {
            // User can borrow more books
            return true;
        }
    } else {
        // Handle query error
        die("Error: " . mysqli_error($dbc));
    }
}

