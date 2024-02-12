<?php
$con = mysqli_connect("localhost", "root", "", "librarydb1");

// Removed the check for the search parameter to fetch all books initially
$query = "SELECT * FROM books";

$query_run = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Search</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="table" id="library_table">
        <section class="table__header">
            <h1>Library Catalog</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Books..." required value="<?php if (isset($_GET['search'])) {
                                                                                        echo $_GET['search'];
                                                                                    } ?>" class="form-control" placeholder="Search by book title or author">
                <img src="images/search.png" alt="">

            </div>

        </section>
        <section class="table__body">
            <table>
            <thead>
    <tr>
        <th>Cover</th>
        <th>Title</th>
        <th>Author</th>
        <th>Pages</th>
        <th>Category</th>
        <th>Publication Date</th>
    </tr>
</thead>
<tbody>
    <?php
    if ($query_run) {
        while ($book = mysqli_fetch_assoc($query_run)) {
    ?>
            <tr>
                <td>
                    <a href="book_details.php?isbn=<?= $book['isbn']; ?>">
                        <img src="<?= $book['cover']; ?>" alt="Cover Photo" style="width: 50px; height: 50px;">
                    </a>
                </td>
                <td>
                    <a href="book_details.php?isbn=<?= $book['isbn']; ?>">
                        <?= $book['title']; ?>
                    </a>
                </td>
                <td><?= $book['authorName']; ?></td>
                <td><?= $book['pagesNumber']; ?></td>
                <td><?= $book['category']; ?></td>
                <td><?= $book['publicationDate']; ?></td>
            </tr>
    <?php
        }
    } else {
    ?>
        <tr>
            <td colspan="6">No Records Found</td>
        </tr>
    <?php
    }
    ?>
</tbody>

            </table>
        </section>
    </main>
    <script src="script.js"></script>
</body>

</html>
