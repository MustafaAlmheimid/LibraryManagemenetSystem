<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $searchQuery = $_POST["searchQuery"];

    // Use Google Books API to search for the book
    $api_key = "AIzaSyBC7lbXKr7YFRtL8ujpEbv2QGQ7A8Dinsw";
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($searchQuery) . "&key=" . $api_key . "&langRestrict=en";

    $response = file_get_contents($url);

    // Output the raw API response for debugging
    echo "Raw API Response: <br>";
    echo "<pre>" . print_r(json_decode($response, true), true) . "</pre>";

    if ($response) {
        $data = json_decode($response, true);

        if (isset($data["items"][0])) {
            $bookInfo = $data["items"][0]["volumeInfo"];

            // Extract all available information
            $isbn = isset($bookInfo["industryIdentifiers"][0]["identifier"]) ? $bookInfo["industryIdentifiers"][0]["identifier"] : "";
            $title = isset($bookInfo["title"]) ? $bookInfo["title"] : "";
            $authorName = isset($bookInfo["authors"][0]) ? $bookInfo["authors"][0] : "";
            $pagesNumber = isset($bookInfo["pageCount"]) ? $bookInfo["pageCount"] : "";
            $category = isset($bookInfo["categories"][0]) ? $bookInfo["categories"][0] : "";
            $publicationDate = isset($bookInfo["publishedDate"]) ? $bookInfo["publishedDate"] : "";
            $language = isset($bookInfo["language"]) ? $bookInfo["language"] : "";
            $publisher = isset($bookInfo["publisher"]) ? $bookInfo["publisher"] : "";
            $description = isset($bookInfo["description"]) ? $bookInfo["description"] : "";
            $isAvailable = "1"; // Assuming the book is available by default
            $price = ""; // You might want to get this information from another source or leave it empty
            $cover = isset($bookInfo["imageLinks"]["thumbnail"]) ? $bookInfo["imageLinks"]["thumbnail"] : "";

            // Insert the book into the database
            $sql = "INSERT INTO books (isbn, title, authorName, pagesNumber, category, publicationDate, language, publisher, description, isAvailable, price, cover) 
                    VALUES ('$isbn', '$title', '$authorName', '$pagesNumber', '$category', '$publicationDate', '$language', '$publisher', '$description', '$isAvailable', '$price', '$cover')";

            if ($conn->query($sql) === TRUE) {
                echo "Book added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Book not found!";
        }
    } else {
        echo "Unable to fetch data from Google Books API.";
    }
}

$conn->close();
?>
