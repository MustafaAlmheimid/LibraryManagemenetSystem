<?php
// Your existing code...

// Add the new buttons with icons and center them
echo '<div class="d-flex justify-content-center mt-4">'; // d-flex is for flex display, justify-content-center is for centering
echo '<div class="btn-group" role="group" aria-label="Dashboard Actions">';

// Add New Book Button
echo '<a href="add_new_book.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Book</a>';

// Delete Book Button
echo '<a href="delete_book.php" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Book</a>';

// Show Users Button
echo '<a href="show_users.php" class="btn btn-info"><i class="fa fa-users"></i> Show Users</a>';

// Show Borrowing History Button
echo '<a href="borrowing_history.php" class="btn btn-warning"><i class="fa fa-history"></i> Borrowing History</a>';

echo '</div>';
echo '</div>';

// Include the rest of your dashboard content
include('statPanel.php');
?>
