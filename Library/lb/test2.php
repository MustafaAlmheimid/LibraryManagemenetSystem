<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "librarydb1";
$table=array();
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = ""; // Initialize the variable

$isbn = $title = $authorName = $pagesNumber = $category = $publicationDate = $language = $publisher = $description = $cover = $nbofcopies = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $searchQuery = $_POST["searchQuery"];

    // Use Google Books API to search for the book
    $api_key = "AIzaSyBC7lbXKr7YFRtL8ujpEbv2QGQ7A8Dinsw";
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($searchQuery) . "&key=" . $api_key . "&langRestrict=en";

    $response = file_get_contents($url);

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
            $cover = isset($bookInfo["imageLinks"]["thumbnail"]) ? $bookInfo["imageLinks"]["thumbnail"] : "";
         $table=array($isbn,$title,$authorName,$pagesNumber,$category,$publicationDate,
         $language,$publisher, $description,$cover);
        
        } else {
            echo "Book not found!";
        }
    } else {
        echo "Unable to fetch data from Google Books API.";
    }
}

// Display the form with search result and add to database button
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search and Add</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="searchQuery">Search for a book:</label>
                <input type="text" class="form-control" id="searchQuery" name="searchQuery" value="<?php echo $searchQuery; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <hr>

        <?php if ($isbn): ?>
            <form method="post" action="test22.php">
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $isbn; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="authorName">Author:</label>
                    <input type="text" class="form-control" id="authorName" name="authorName" value="<?php echo $authorName; ?>">
                </div>

                <div class="form-group">
                    <label for="pagesNumber">Pages:</label>
                    <input type="text" class="form-control" id="pagesNumber" name="pagesNumber" value="<?php echo $pagesNumber; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo $category; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="publicationDate">Publication Date:</label>
                    <input type="text" class="form-control" id="publicationDate" name="publicationDate" value="<?php echo $publicationDate; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="language">Language:</label>
                    <input type="text" class="form-control" id="language" name="language" value="<?php echo $language; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $publisher; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" readonly><?php echo $description; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="cover">Cover:</label>
                    <img src="<?php echo $cover; ?>" alt="Book Cover" class="img-thumbnail" style="max-width: 100px; max-height: 150px;">
                <input type="hidden" name="cover1" value="<?php echo $cover; ?>">
                </div>

                <div class="form-group">
                    <label for="nbofcopies">Number of Copies:</label>
                    <input type="number" class="form-control" id="nbofcopies" name="nbofcopies" value="<?php echo $nbofcopies; ?>">
                </div>

                <div class="form-group">
                    <label for="customCover">Custom Cover Link:</label>
                    <input type="text" class="form-control" id="customCover" name="customCover" placeholder="Enter custom cover link">
                </div>

                <button type="submit" class="btn btn-success">Add to Database</button>
            </form>
        <?php endif; ?>
    </div>

</body>

</html>

<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST" && $isbn) {
//     // Insert the book into the database
//    // Modify these lines to check if the keys exist before using them
//     $nbofcopies = isset($bookInfo["pageCount"]) ? $bookInfo["pageCount"] : "";
//     $cover = isset($bookInfo["imageLinks"]["thumbnail"]) ? $bookInfo["imageLinks"]["thumbnail"] : "";

//     // Use the custom cover link if provided, otherwise use the API cover link
//     $cover = !empty($customCover) ? $customCover : $cover;

//     // Use prepared statements to prevent SQL injection
//     $stmt = $conn->prepare("INSERT INTO books (isbn, title, authorName, pagesNumber, category, publicationDate, language, publisher, description, isAvailable, price, cover, nbOfCopies) 
//                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, '', ?, ?)");
// $stmt->bind_param("sssssssssssi", $isbn, $title, $authorName, $pagesNumber, $category, $publicationDate, $language, $publisher, $description, $cover, $nbofcopies);

//     if ($stmt->execute()) {
//         echo "Book added successfully!";
//     } else {
//         echo "Error: " . $stmt->error;
//     }

//     $stmt->close();
// }
$conn->close();
?>
