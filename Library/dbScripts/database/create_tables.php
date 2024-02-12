<?php
include('connect.php');
try {
    $conn_db = $conn->select_db(DATABASE_NAME);

    if (!$conn_db) {
        throw new Exception("DATABASE SELECTION FAILED: " . $conn->error);
    }

    // Creating tables
    $queryTables = "
        CREATE TABLE users (
            userId int(11) NOT NULL,
            firstName varchar(40) NOT NULL,
            lastName varchar(40) NOT NULL,
            email varchar(255) NOT NULL UNIQUE,
            address varchar(255) NOT NULL,
            age int(11) NOT NULL,
            phoneNumber varchar(40) NOT NULL,
            interests varchar(255) NOT NULL,
            password varchar(255) DEFAULT NULL,
            role varchar(10) DEFAULT NULL
        );

        CREATE TABLE books (
            isbn varchar(50) NOT NULL,
            title varchar(400) NOT NULL,
            authorName varchar(400) NOT NULL,
            pagesNumber int(11) NOT NULL,
            category varchar(120) NOT NULL,
            publicationDate varchar(255) DEFAULT NULL,
            language varchar(20) NOT NULL,
            publisher varchar(400) NOT NULL,
            description varchar(1000) NOT NULL,
            isAvailable tinyint(4) NOT NULL,
            cover varchar(1000) NOT NULL,
            nbOfCopies int(11) DEFAULT 1,
            price float DEFAULT NULL
        );

        CREATE TABLE rating (
            ratingValue float NOT NULL,
            review varchar(255) NOT NULL,
            isbn varchar(50) NOT NULL,
            userId int(11) NOT NULL
        );

        CREATE TABLE reservation (
            userId int(11) NOT NULL,
            isbn varchar(50) NOT NULL,
            reservationDate datetime DEFAULT current_timestamp(),
            expireDate datetime DEFAULT (current_timestamp() + interval 10 day)
        );

        CREATE TABLE borrowing (
            borrowingId int(11) NOT NULL,
            userId int(11) NOT NULL,
            isbn varchar(50) NOT NULL,
            dateFrom date NOT NULL,
            dateTo date NOT NULL
        );
    ";

    // Creating constraints
    $queryConstraints = "
        ALTER TABLE books
            ADD PRIMARY KEY(isbn);

        ALTER TABLE users
        MODIFY COLUMN userId INT AUTO_INCREMENT PRIMARY KEY;

        ALTER TABLE rating
            ADD PRIMARY KEY(isbn, userId);

        ALTER TABLE reservation
            ADD PRIMARY KEY(userId, isbn);

        ALTER TABLE borrowing
            ADD PRIMARY KEY(borrowingId);

        ALTER TABLE reservation
            ADD CONSTRAINT fk_userId
            FOREIGN KEY (userId)
            REFERENCES users(userId);

        ALTER TABLE reservation
            ADD CONSTRAINT fk_isbn
            FOREIGN KEY (isbn)
            REFERENCES books(isbn);

        ALTER TABLE borrowing
            ADD CONSTRAINT fk_userId_br
            FOREIGN KEY (userId)
            REFERENCES users(userId);

        ALTER TABLE borrowing
            ADD CONSTRAINT fk_isbn_br
            FOREIGN KEY (isbn)
            REFERENCES books(isbn);

        ALTER TABLE rating
            ADD CONSTRAINT fk_userId_rt
            FOREIGN KEY (userId)
            REFERENCES users(userId);

        ALTER TABLE rating
            ADD CONSTRAINT fk_isbn_rt
            FOREIGN KEY (isbn)
            REFERENCES books(isbn);
    ";

    if ($conn->multi_query($queryTables) === FALSE) {
        throw new Exception("DATABASE TABLES CREATION FAILED : " . $conn->error);
    }

    // Consume results of the first query
    while ($conn->more_results()) {
        $conn->next_result();
    }

    if ($conn->multi_query($queryConstraints) === FALSE) {
        throw new Exception("DATABASE CONSTRAINTS CREATION FAILED : " . $conn->error);
    }

    SUCCESS_MESSAGE("DATABASE TABLES AND CONSTRAINTS CREATED SUCCESSFULLY");
} catch (Exception $e) {
    ERROR_MESSAGE($e->getMessage());
}
