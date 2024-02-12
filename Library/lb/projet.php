<html lang="en">

<head>
  
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

<!-- TypedJS script -->
<script src="typed.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReadersHome</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<style>
  
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
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
    background-color: #ffffff; /* Very light shade of blue, almost white */
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

        .shoping {
            width: 30px;
            height: 30px;
        }

        #categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        

        .category {
            width: 30%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
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
        .booktitle{
            padding: 10px;
            text-align: left;
            font-size: 50px;
  /* font-family: "Lato", sans-serif; */
  font-family: "Playfair Display SC", serif;
  margin-bottom:10px;
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

        .home {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #f8f8f8
        }

        .hero {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
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
            box-shadow: 0 8px 12px #001f3f; /* Navy Blue shadow on hover */
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

        .book-description-info {
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

        .reservation-button {
            display: inline-block;
            background-color: #004080;;
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
            background-color: #004080; /* Darker Navy Blue on hover */
        }

        .availability-status {
            margin-top: 5px;
            font-weight: bold;
        }

        .available {
            color: #004080;
        }

        .not-available {
            color: #5b85a7;
        }

        .book-info-row {
            margin-top: 5px;
        }

        .transparent-book-card {
            transition: opacity 0.5s;
        }

        .transparent-book-card.hide {
            opacity: 0.2;
        }

        /* Additional styling for the search button */
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
        .container3 {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: row-reverse;
      padding: 20px;
    }

    .about-img {
      max-width: 40%;
      height: auto;
      padding: 20px;
    }

    .about-content {
      max-width: 600px;
      text-align: center;
      margin-top: 20px;
    }

    .about-content .title {
      font-family: 'Lobster', cursive;
      font-size: 2em;
      margin-bottom: 10px;
      color: #ffffff;
      text-shadow: 2px 2px 5px #001f3f;
    }

    .feedback-container {
      background-color: #fdfdfd;
      padding: 20px;
      margin-top: 20px;
      text-align: center;
      box-shadow: 0 4px 6px #001f3f; /* Navy Blue shadow */
    }

    .feedback-box {
      width: 80%;
      margin: 0 auto;
      text-align: left;
    }

    .feedback-image {
      max-width: 250px;
      margin-top: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .feedback-textarea {
      width: 100%;
      height: 150px;
      resize: none;
    }

    .submit-button {
      background-color: #5b85a7;
      color: #ffffff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      display: block;
      margin: 20px 0 20px auto;
      border-radius: 5px;
    }

    footer {
      background-color: #9bc1e3;
      padding: 5px;
      text-align: center;
    }
    .feedback-textarea {
  width: 100%;
  height: 150px;
  resize: none;
  color: #6d6a6a; /* Dark grey color */
}
/* Add this CSS to your existing styles */
.account-dropdown {
    position: relative;
    display: inline-block;
    color: #3b3f44;
}

.account-options {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 220px;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
}
#books-button {
    display: none;
    background-color: #3498db; /* Light blue color */
    color: #fff; /* White text color */
    border: none;
    padding: 15px 30px; /* Padding for a larger button */
    border-radius: 10px; /* Rounded corners */
    font-size: 18px; /* Larger font size */
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    display: block;
}

#books-button:hover {
    background-color: #2980b9; /* Darker blue color on hover */
}
.account-dropdown:hover .account-options {
    display: block;
}

.account-options a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.account-options a:hover {
    background-color: #ddd;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info img {
    margin-left: 5px;
}

.user-details {
    text-align: left;
}

.user-name {
    font-weight: bold;
}

.user-email {
    color: #555;
}
/* Additional styles for the swiper container and slides */
.swiper-container {
            margin-top: 20px;
        }

        .swiper-slide {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .swiper-slide img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

<?php
        // Check if the relevant cookies exist
        if (isset($_COOKIE['userId']) && isset($_COOKIE['userEmail']) && isset($_COOKIE['firstName']) && isset($_COOKIE['lastName'])) {
            $firstName = $_COOKIE['firstName'];
            $lastName = $_COOKIE['lastName'];
        }
        ?>

    </style>
    </head>
    <script src='typed.min.js'></script>
    <script>
 document.addEventListener('DOMContentLoaded', function () {
    var changingSentenceElement = document.getElementById('changing-sentence');
    var booksButton = document.getElementById('books-button');

    function updateSentence() {
        changingSentenceElement.textContent = "Welcome, <?php echo $firstName; ?> <?php echo $lastName; ?>!";

        setTimeout(function () {
            changingSentenceElement.textContent = "Have you read today?";
        }, 4000); // Display the second sentence after 5 seconds
        setTimeout(function () {
            changingSentenceElement.textContent = "1? 2 ?3 Books aren't enough";
        }, 7000); // Display the second sentence after 5 seconds
        setTimeout(function () {
            changingSentenceElement.innerHTML = " READ MORE !</h1>";
            booksButton.style.display = 'block';
        }, 10000); // Display "READ MORE!" after 10 seconds
    }

    // Call the function once to immediately display the first sentence
    updateSentence();
});


  </script>

<body>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>

   
   
 <!---Header section goes here-->

 <nav class="gs-navbar">
      <!--logo-->
      <img src='rh2.png'alt="logo" >
           
      

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="options">
            <a href="searchh.php" class='search'> <i class="fa fa-search" ></i>Filter</a>
                <a href="#home">Home</a>
                <a href="#about">About Us</a>
                <div class="account-dropdown">
    <a>Account</a>
    <div class="account-options">
        <?php
        if (isset($_COOKIE['userId']) && isset($_COOKIE['userEmail']) && isset($_COOKIE['firstName']) && isset($_COOKIE['lastName'])) {
            echo '<a class="dashboard-link" href="LogIn/logoutScript.php">Logout</a>
                <div class="user-info">
                    <img src="./user.svg" alt="user_icon">
                    <div class="user-details">
                        <span class="user-name">' . $_COOKIE['firstName'] . ' ' . $_COOKIE['lastName'] . '</span>
                        <span class="user-email">' . $_COOKIE['userEmail'] . '</span>
                    </div>
                </div>';
        } else {
            echo '<a class="dashboard-link" href="LogIn/loginn.php">Login</a>';
        }
        ?>
    </div>
</div>

                <a href="#books">Books</a>
                <a href="contactUs.php">Contact us</a>
            
                
                <a href="cart.php">Cart</a>
    
         
                
                <?php
                    // Check if the user is an admin, and if so, display the dashboard link
                    if (isset($_COOKIE['role']) && $_COOKIE['role'] == 'admin') {
                        echo '
                            <a class="nav-link" href="dashboard.php"><b>Dashboard</b></a>
                        ';
                    }
                    ?>
            </div>
           
               
        
            </nav>


            <script src="index.js"></script>
            
            
    <div class="header" id="home">
    <div class="header-content">
        
     
 
    
             <div class="home">
        <div class="hero">
            <h1 id="changing-sentence" style="color: blue; font-size: 62; font-family: 'Poppins', sans-serif;
           margin-top:180px">  
           
             </h1>
            <button onclick="window.location.href='books.php'" id="books-button" style="display: none;"> Books </button>
        </div>
    </div>
  </div>


    <div class="header-wave">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                class="shape-fill" id="h-wave"></path>
        </svg>
    </div>
</div>
    
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var navbar = document.querySelector('.gs-navbar');

    window.addEventListener('scroll', function () {
      if (window.scrollY > 50) {
        navbar.classList.add('transparent');
      } else {
        navbar.classList.remove('transparent');
      }
    });
  });
</script>
           
<!---About Us section goes here-->
        
    <section class="mt-5" >
   

    <div class="aboutus-section-wrapper" id="about">
            <div class="aboutus-section-container">
                <div class="aboutus-container">
                    <div class="aboutus-img-container">
                        <img src="img3.png">
                    </div>
                    <div class="aboutus-text-container">
   
      
                <h1 id="h1-aboutus-section-1">A glimpse of <span>Us</span></h1>
                <div class="h-line"></div>
                <br>
        
                <p id="p-aboutus-section-1">ReadersHome is more than just a library; it's your ultimate reading destination. We have been proudly serving the community for over 25 years, providing a haven for book enthusiasts and knowledge seekers.
          Our online platform is open 24/7, allowing you to check available books, make reservations, and explore our extensive collection from the comfort of your home. Whether you're a night owl or an early bird, ReadersHome is always at your service.
          For those seeking a quiet reading space, our physical library, established more than two decades ago, offers a serene corner where you can immerse yourself in books without distractions. It's a place to experience the joy of reading and discover a world of knowledge.
          Come and visit ReadersHome your sanctuary for reading, learning, and relaxation.</p>
      </div>
    </div>
  </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                $(".book-card-info").each(function() {
                    var offset = $(this).offset().top;
                    var height = $(this).height();
                    if (scroll > offset && scroll < offset + height) {
                        $(this).addClass("transparent-book-card hide");
                    } else {
                        $(this).removeClass("hide");
                    }
                });
            });
        });
    </script>

    <!-- ... Your existing PHP code ... -->
   
    
<!-- Books section -->
<
<!-- Books section -->
<div id="books" class="container">
    <br><br><br>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class='booktitle'>Books</h1>
        <div class="form-inline">
            <input type="text" id="searchInput" class="form-control" placeholder="Search books">
            <button onclick="searchBooks()" class="btn btn-primary btnsearch">Search</button>
        </div>
    </div>
    <div class="book-grid" id="searchResults">
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

        // Fetch 5 random books from the database
        $sql = "SELECT * FROM books ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-card'>";
                echo "<img src='" . $row['cover'] . "' alt='Book Cover'>";
                echo "<div class='book-title-info'>" . $row['title'] . "</div>";
                echo "<div class='book-author-info'>" . $row['authorName'] . "</div>";
                echo "<a href='book_details.php?isbn=" . $row['isbn'] . "' class='reservation-button'>Show Details</a>";
                echo "<a href='book_review.php?isbn=" . $row['isbn'] . "' class='reservation-button'>Add Review</a>";
                echo "</div>";
            }
        } else {
            echo "No books found in the database.";
        }

        $conn->close();
        ?>
    </div>
</div>

          
        </br></br></br></br></br>
     <footer>
    <p>&copy; 2024 ReadersHome. All rights reserved.</p>
  </footer>

  <script src="app.js"></script>
  
<script>
    function searchBooks() {
        var searchInput = document.getElementById("searchInput").value;
        var searchResultsContainer = document.getElementById("searchResults");

        // Make an AJAX request to your server with the search input
        $.ajax({
            type: "GET",
            url: "searchfct.php",
            data: { search: searchInput },
            success: function (response) {
                // Update the search results container with the response from the server
                searchResultsContainer.innerHTML = response;
            },
            error: function (error) {
                console.log("Error:", error);
            }
        });
    }
</script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.getElementById('web-contents').style.display = 'none';
        setTimeout(function () {
            $('.loader').fadeToggle();
            document.getElementById('web-contents').style.display = 'block';
        }, 2500);
    </script>

</body>

</html>