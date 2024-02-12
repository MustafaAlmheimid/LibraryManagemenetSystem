<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="Resources/swiper/swiper-bundle.min.css">
    <script src="Resources/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <style>
        /* Add any additional styles needed for the search page */

        body {
            font-family: 'Helvetica', sans-serif;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 20vh;
            width: 100%;
            margin-right: auto;
            margin-left: auto;
            background-color: #ffffff;
            animation: fade 1s ease-in-out;
        }

        @keyframes fade {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .container {
            padding: 20px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 10px;
            padding: 10px;
        }

        .book-card {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .book-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .book-author {
            margin-bottom: 5px;
        }

        .book-price {
            color: #4a4a4a;
        }

        .book-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 20px;
            margin-top: 20px;
        }

        .book-card-info {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            transition: transform 0.6s;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .book-card-info:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 12px #001f3f;
        }

        .book-cover-info {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .book-title-info {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        .book-author-info {
            color: #555;
            margin-top: 5px;
        }

        .reservation-button {
            display: inline-block;
            background-color: #004080;
            color: white;
            text-align: center;
            border-radius: 4px;
            padding: 8px 16px;
            margin-top: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .reservation-button:hover {
            background-color: #004080;
        }

        .transparent-book-card {
            transition: opacity 0.5s;
        }

        .transparent-book-card.hide {
            opacity: 0.2;
        }

        .navbar-form {
            margin-left: auto;
        }

        .navbar-form .form-inline {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .search-button {
            margin-left: 10px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #004080; /* Adjust the background color as needed */
            padding: 10px;
            color: white; /* Adjust text color as needed */
        }

        .navbar a {
            color: white; /* Adjust text color as needed */
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <div id='books' class="container">
        <br><br><br>
        

      
        <div class="book-info">
            <?php
            // Assuming you have a database connection established
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "librarydb1";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch books from the database based on search criteria
            if (isset($_GET['search'])) {
                $search = $conn->real_escape_string($_GET['search']);
                $sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR authorName LIKE '%$search%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='book-card-info'>";
                        echo "<img class='book-cover-info' src='" . $row['cover'] . "' alt='Book Cover'>";
                        echo "<div class='book-title-info'>" . $row['title'] . "</div>";
                        echo "<div class='book-author-info'>" . $row['authorName'] . "</div>";
                        echo "<a href='book_details.php?isbn=" . $row['isbn'] . "' class='reservation-button'>Show Details</a>";
                        echo "<a href='book_review.php?isbn=" . $row['isbn'] . "' class='reservation-button'>Add Review</a>";
                        echo "</div>";
                    }
                } else {
                    echo "No books found matching the search criteria.";
                }
            } else {
                echo "Please enter a search term.";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
