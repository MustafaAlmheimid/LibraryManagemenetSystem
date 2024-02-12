<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $searchQuery = isset($_POST["searchQuery"]) ? $conn->real_escape_string($_POST["searchQuery"]) : "";
    
    if (!empty($searchQuery)) {
        // Use Google Books API to search for the book
        $api_key = "AIzaSyDJmzwV1ZMEa2b0yAbL5IGwf3nCxa0Gl0M"; // Replace with your actual API key
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($searchQuery) . "&key=" . $api_key . "&langRestrict=en";
        $response = file_get_contents($url);

        if ($response) {
            $data = json_decode($response, true);

            if (isset($data["items"][0])) {
                $bookInfo = $data["items"][0]["volumeInfo"];

                // Extract all available information
                $isbn = isset($bookInfo["industryIdentifiers"][0]["identifier"]) ? $conn->real_escape_string($bookInfo["industryIdentifiers"][0]["identifier"]) : "";
                $title = isset($bookInfo["title"]) ? $conn->real_escape_string($bookInfo["title"]) : "";
                $authorName = isset($bookInfo["authors"][0]) ? $conn->real_escape_string($bookInfo["authors"][0]) : "";
                $pagesNumber = isset($bookInfo["pageCount"]) ? (int)$bookInfo["pageCount"] : 0;
                $category = isset($bookInfo["categories"][0]) ? $conn->real_escape_string($bookInfo["categories"][0]) : "";
                $publicationDate = isset($bookInfo["publishedDate"]) ? $conn->real_escape_string($bookInfo["publishedDate"]) : "";
                $language = isset($bookInfo["language"]) ? $conn->real_escape_string($bookInfo["language"]) : "";
                $publisher = isset($bookInfo["publisher"]) ? $conn->real_escape_string($bookInfo["publisher"]) : "";
                $description = isset($bookInfo["description"]) ? $conn->real_escape_string($bookInfo["description"]) : "";
                $isAvailable = 1; // Assuming the book is available by default
                $price = 0; // You might want to get this information from another source or leave it as 0
                $cover = isset($bookInfo["imageLinks"]["thumbnail"]) ? $conn->real_escape_string($bookInfo["imageLinks"]["thumbnail"]) : "";

                // Insert the book into the database using prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO books (isbn, title, authorName, pagesNumber, category, publicationDate, language, publisher, description, isAvailable, price, cover) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bind_param("sssiissssiis", $isbn, $title, $authorName, $pagesNumber, $category, $publicationDate, $language, $publisher, $description, $isAvailable, $price, $cover);

                if ($stmt->execute()) {
                    echo "Book added successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Book not found!";
            }
        } else {
            echo "Unable to fetch data from Google Books API.";
        }
    } else {
        echo "Invalid search query!";
    }
}

$conn->close();
?>
