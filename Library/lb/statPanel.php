<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Library Statistics</title>
    <style>
        /* Add any additional custom styles here */

        /* Custom style for cards */
        .custom-card {
            background-color: #007BFF; /* Blue color */
            color: #FFFFFF; /* White text */
        }

    </style>
</head>

<body>

    <?php include 'statistics.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Users</h5>
                        <p class="card-text"><?= usersNumber() ?></p>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Books</h5>
                        <p class="card-text"><?= booksNumbers() ?></p>
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Average Borrow Count</h5>
                        <p class="card-text"><?= getAverageBorrowCount() ?></p>
                        <i class="fas fa-chart-bar fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>

        <?php getTopRequestedBooks(1); ?>


        <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
