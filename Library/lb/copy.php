<?php
// Replace with your actual database connection details
$servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "librarydb1";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT isbn, title, description, cover FROM books";
$result = $conn->query($sql);

$books = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Online</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px;
    }

    #slideshow-container {
      max-width: 800px;
      position: relative;
      margin: auto;
    }

    .book-slide {
      display: none;
      position: absolute;
      width: 100%;
      height: auto;
    }

    .book-description {
      position: absolute;
      top: 0;
      right: 0;
      width: 300px;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #prev, #next {
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      margin-top: -22px;
      color: white;
      font-weight: bold;
      font-size: 18px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      cursor: pointer;
    }

    #prev { left: 0; }
    #next { right: 0; }

    #prev:hover, #next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
  </style>
</head>


<body>

  <header>
    <h1>Library Online</h1>
  </header>

  <div id="slideshow-container">
    <?php foreach ($books as $book): ?>
      <div class="book-slide">
        <img src="<?php echo $book['cover']; ?>" alt="<?php echo $book['title']; ?>">
        <div class="book-description">
          <h2><?php echo $book['title']; ?></h2>
          <p><?php echo $book['description']; ?></p>
        </div>
      </div>
    <?php endforeach; ?>

    <button id="prev" onclick="plusSlides(-1)">❮</button>
    <button id="next" onclick="plusSlides(1)">❯</button>
  </div>

  <script>
    // JavaScript code remains the same
  </script>

</body>
</html>
