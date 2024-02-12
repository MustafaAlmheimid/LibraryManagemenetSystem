<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 20px;
            margin-top: 20px;
        }

        .book-card {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            transition: transform 0.3s;
            position: relative;
        }

        .book-card:hover {
            transform: scale(1.05);
        }

        .book-cover {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .book-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .book-author {
            color: #555;
            margin-top: 5px;
        }

        .book-description {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 8px;
        }

        .book-card:hover .book-description {
            opacity: 1;
        }
    </style>
</head>

<body>

    <h1>Book Library</h1>

    <div class="book-grid">
        <?php
        // Assuming you have a database connection established
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "librarydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch books from the database
        $sql = "SELECT * FROM books";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-card'>";
                echo " <img class='book-cover' src='" . $row['cover'] . "' alt='Book Cover'>";
                echo "<div class='book-title'>" . $row['title'] . "</div>";
                echo "<div class='book-author'>" . $row['authorName'] . "</div>";
                echo "<div class='book-description'>" . $row['description'] . "</div>";
                echo "</div>";
            }
        } else {
            echo "No books found in the database.";
        }

        $conn->close();
        ?>
    </div>

</body>

</html>
