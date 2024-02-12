<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb1";

function getConnection()
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function usersNumber()
{
    $conn = getConnection();
    $query = "SELECT COUNT(*) as user_count FROM users";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }
    $stmt->execute();
    $stmt->bind_result($userCount);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $userCount;
}

function booksNumbers()
{
    $conn = getConnection();
    $query = "SELECT COUNT(*) as book_count FROM books";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }
    $stmt->execute();
    $stmt->bind_result($bookCount);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $bookCount;
}

function getTopRequestedBooks($n)
{
    $conn = getConnection();
    $query = "SELECT isbn, COUNT(*) as borrow_count FROM borrowing GROUP BY isbn HAVING borrow_count > ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }
    $stmt->bind_param("i", $n);
    $stmt->execute();
    $stmt->bind_result($isbn, $borrowCount);
    $topRequestedBooks = array();
    while ($stmt->fetch()) {
        $bookInfo = getBookInfo($isbn);
        if ($bookInfo) {
            $topRequestedBooks[] = array(
                'isbn' => $isbn,
                'title' => $bookInfo['title'],
                'author' => $bookInfo['authorName'],
                'borrow_count' => $borrowCount
            );
        }
    }
    $stmt->close();
    $conn->close();
  
    echo '<div class="border p-3 mt-5 mb-5">';
    echo '<a href="borrowing_history.php" class="mb-3" style="font-size: 40px; font-weight: bold;">Currently Borrowed</a>';

    // Display the books using Bootstrap
    echo '<div class="container mt-5">';
    foreach ($topRequestedBooks as $book) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">ISBN: ' . $book['isbn'] . '</h5>';
        echo '<p class="card-text">Title: ' . $book['title'] . '</p>';
        echo '<p class="card-text">Author: ' . $book['author'] . '</p>';
        echo '<p class="card-text">Borrow Count: ' . $book['borrow_count'] . '</p>';
        echo '<button type="button" class="btn btn-primary mr-2">Show Book Info</button>';
        echo '<button type="button" class="btn btn-primary mr-2">Show User Info</button>';
        echo '<button type="button" class="btn btn-primary mr-2">Show Borrowing Info</button>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';

    return $topRequestedBooks;
}

// Example function to get book information based on ISBN
function getBookInfo($isbn)
{
    $conn = getConnection();
    $query = "SELECT title, authorName FROM books WHERE isbn = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("i", $isbn);
    $stmt->execute();
    $stmt->bind_result($title, $authorName);

    $bookInfo = null;

    if ($stmt->fetch()) {
        $bookInfo = array(
            'title' => $title,
            'authorName' => $authorName
        );
    }

    $stmt->close();
    $conn->close();

    return $bookInfo;
}




function getCurrentBorrowedBooks()
{
    $conn = getConnection();

    // Assuming there is a 'borrowing_status' field in the 'borrowing' table to indicate the current borrow status
    $query = "SELECT *, COUNT(*) as borrow_count FROM borrowing GROUP BY isbn";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }

    $stmt->execute();
    $stmt->bind_result($isbn, $bookTitle, $author, $borrowCount);
    $currentlyBorrowedBooks = array();

    while ($stmt->fetch()) {
        $currentlyBorrowedBooks[] = array(
            'isbn' => $isbn,
            'book_title' => $bookTitle,
            'author' => $author,
            'borrow_count' => $borrowCount
        );
    }

    $stmt->close();
    $conn->close();

    return $currentlyBorrowedBooks;
}


function getAverageBorrowCount()
{
    $conn = getConnection();

    $query = "SELECT AVG(borrow_count) as avg_borrow_count FROM (SELECT COUNT(*) as borrow_count FROM borrowing GROUP BY isbn) as subquery";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error in preparing the statement: " . $conn->error);
    }

    $stmt->execute();
    $stmt->bind_result($avgBorrowCount);
    $stmt->fetch();

    $stmt->close();
    $conn->close();

    return $avgBorrowCount;
}
