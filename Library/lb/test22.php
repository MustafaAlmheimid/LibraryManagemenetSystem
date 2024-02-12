<?php

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Modify these lines to check if the keys exist before using them
    $nbofcopies = $_POST['nbofcopies'];

    
    $isbn = isset($_POST["isbn"]) ? $conn->real_escape_string($_POST["isbn"]) : "";
    $title = isset($_POST["title"]) ? $conn->real_escape_string($_POST["title"]) : "";
    $authorName = isset($_POST["authorName"]) ? $conn->real_escape_string($_POST["authorName"]) : "";
    $pagesNumber = isset($_POST["pagesNumber"]) ? $conn->real_escape_string($_POST["pagesNumber"]) : "";
    $category = isset($_POST["category"]) ? $conn->real_escape_string($_POST["category"]) : "";
    $publicationDate = isset($_POST["publicationDate"]) ? $conn->real_escape_string($_POST["publicationDate"]) : "";
    $language = isset($_POST["language"]) ? $conn->real_escape_string($_POST["language"]) : "";
    $publisher = isset($_POST["publisher"]) ? $conn->real_escape_string($_POST["publisher"]) : "";
    $description = isset($_POST["description"]) ? $conn->real_escape_string($_POST["description"]) : "";
    
    // Use the custom cover link if provided, otherwise use the API cover link
    $customCover = isset($_POST["customCover"]) ? $conn->real_escape_string($_POST["customCover"]) : "";
    $cover = !empty($customCover) ? $customCover : "";

    // If customCover is not set, use cover1 value
    if (empty($cover)) {
        $cover = isset($_POST["cover1"]) ? $conn->real_escape_string($_POST["cover1"]) : "";
    }

    // Set default values for isAvailable and price
    $isAvailable = 1;
    $price = 0;

    // Use prepared statements to prevent SQL injection
    $insertSql = $conn->prepare("INSERT INTO books (isbn, title, authorName, pagesNumber, category, publicationDate, language, publisher, description, isAvailable, price, cover, nbOfCopies) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$insertSql) {
        echo "Error: " . $conn->error;
    }

    $insertSql->bind_param("ssssssssssisi", $isbn, $title, $authorName, $pagesNumber, $category, $publicationDate, $language, $publisher, $description, $isAvailable, $price, $cover, $nbofcopies);

    if ($insertSql->execute()) {
        echo "New book added successfully!";
    } else {
        echo "Error: " . $insertSql->error;
    }

    $insertSql->close();
}

$conn->close();
?>
