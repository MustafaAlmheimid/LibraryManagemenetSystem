<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="Resources/swiper/swiper-bundle.min.css">
    <script src="Resources/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="typed.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadersHome</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <style>
        
/*Scroll-to-top button CSS*/
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: rgba(168, 186, 248, 0.267);
  color: white;
  cursor: pointer;
  padding: 12px 18px;
  border-radius: 50px;
}

#myBtn:hover {
  background-color: rgb(18, 18, 18);
}

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
        background-color: #ffffff; /* Adjust the background color as needed */
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
        <div class="navbar">

    <button onclick="goBack()" class="btn btn-primary">Go Back</button>
    <form method="GET" action="searchfct.php" class="form-inline">
    <input type="text" name="search" class="form-control" placeholder="Search books">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
  
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top" style="display: block;"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>


        <h1 class='booktitle'>Books</h1>
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

            // Fetch books from the database
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='book-card-info'>";
                    echo "<img class='book-cover-info' src='" . $row['cover'] . "' alt='Book Cover'>";
                    echo "<div class='book-title-info'>" . $row['title'] . "</div>";
                    echo "<div class='book-author-info'>" . $row['authorName'] . "</div>";
                    echo "<a href='book_details.php?isbn=" . $row['isbn'] . "' class='reservation-button'>Show Details</a>";
                    echo "<a href='book_review.php?isbn=" . $row['isbn'] . "' class='reservation-button'>add review</a>";
                    echo "</div>";
                }
            } else {
                echo "No books found in the database.";
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
    
    <script>
    
let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
    
</body>

</html>
