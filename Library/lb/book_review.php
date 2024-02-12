<!-- book_review.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <!-- Include ion.rangeSlider CSS and JS files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
</head>

<body class="container mt-5">
    <?php
    // Check if the user is logged in
    if (!isset($_COOKIE['userId']) || empty($_COOKIE['userId'])) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo "Login to add a review.<br>";
        echo "<a href='LogIn/loginn.php' class='btn btn-info mt-3'>Login</a>";
        echo "</div>";
    } else {
        // Get book ISBN from the query string
        $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';

        // Check if the ISBN is provided
        if (empty($isbn)) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Invalid request. Please select a book to add a review.";
            echo "</div>";
        } else {
            // Display the review form
            echo "<h2>Add Review</h2>";
            echo "<form action='process_review.php' method='post'>";
            echo "<input type='hidden' name='isbn' value='" . $isbn . "'>";
            echo "<input type='hidden' name='userId' value='" . $_COOKIE['userId'] . "'>";

            // Rating Slider
            echo "<div class='form-group'>";
            echo "<label for='rating'>Rating:</label>";
            echo "<input type='text' id='rating' name='rating' />";
            echo "</div>";

            // Review Description
            echo "<div class='form-group'>";
            echo "<label for='review'>Review:</label>";
            echo "<textarea class='form-control' name='review' id='review' rows='4'></textarea>";
            echo "</div>";

            // Submit Button
            echo "<button type='submit' class='btn btn-primary'>Submit Review</button>";
            echo "</form>";
        }
    }
    ?>

    <a href="book_details.php?isbn=<?php echo $isbn; ?>" class="btn btn-secondary mt-3">Back to Book Details</a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Include ion.rangeSlider JS file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <script>
        // Initialize the rating slider
        $(document).ready(function () {
            $("#rating").ionRangeSlider({
                min: 1,
                max: 5,
                step: 1,
                from: 3, // Initial value, you can set it to any default value
                grid: true,
                grid_num: 5,
                postfix: " Stars",
                values: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            });
        });
    </script>
</body>

</html>
