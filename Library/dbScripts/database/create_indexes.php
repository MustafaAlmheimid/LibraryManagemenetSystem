<?php
include('connect.php');
try {
    $conn_db = $conn->select_db(DATABASE_NAME);

    if (!$conn_db) {
        throw new Exception("DATABASE SELECTION FAILED: " . $conn->error);
    }

    // Adding indexes
    $queryIndexes = "
        CREATE INDEX idx_users_email ON users (email);
        CREATE INDEX idx_users_password ON users (password);
        CREATE INDEX idx_books_title ON books (title);
    ";

    if ($conn->multi_query($queryIndexes) === FALSE) {
        throw new Exception("INDEX CREATION FAILED: " . $conn->error);
    }

    // Consume results of the query
    while ($conn->more_results()) {
        $conn->next_result();
    }

    SUCCESS_MESSAGE("INDEXES CREATED SUCCESSFULLY");
} catch (Exception $e) {
    ERROR_MESSAGE($e->getMessage());
}
