<?php
include('connect.php');

try {
    $conn_db = $conn->select_db(DATABASE_NAME);

    if (!$conn_db) {
        throw new Exception("DATABASE SELECTION FAILED: " . $conn->error);
    }
    // Trigger 1: after_delete_borrowing
    $query1 = "
    CREATE TRIGGER `after_delete_borrowing` AFTER DELETE ON `borrowing`
    FOR EACH ROW BEGIN
        UPDATE books
        SET nbOfCopies = nbOfCopies + 1
        WHERE isbn = OLD.isbn;
        UPDATE books
        SET isAvailable = 1
        WHERE isbn = OLD.isbn AND nbOfCopies > 0;
    END";

    if ($conn->query($query1) === FALSE) {
        throw new Exception("TRIGGER CREATION FAILED: " . $conn->error);
    }

    // Trigger 2: before_insert_borrowing
    $query2 = "
    CREATE TRIGGER `before_insert_borrowing` BEFORE INSERT ON `borrowing`
    FOR EACH ROW BEGIN
        DELETE FROM reservation
        WHERE userId = NEW.userId AND isbn = NEW.isbn;
    END";

    if ($conn->query($query2) === FALSE) {
        throw new Exception("TRIGGER CREATION FAILED: " . $conn->error);
    }

    // Trigger 3: before_insert_reservation
    $query3 = "
    CREATE TRIGGER `before_insert_reservation` BEFORE INSERT ON `reservation`
    FOR EACH ROW BEGIN
        DECLARE availableCopies INT;

        SELECT nbOfCopies
        INTO availableCopies
        FROM books
        WHERE isbn = NEW.isbn;

        IF availableCopies > 0 THEN
            UPDATE books
            SET nbOfCopies = nbOfCopies - 1
            WHERE isbn = NEW.isbn;

            IF (availableCopies - 1) = 0 THEN
                UPDATE books
                SET isAvailable = 0
                WHERE isbn = NEW.isbn;
            END IF;
        ELSE
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No available copies for reservation';
        END IF;
    END";

    if ($conn->query($query3) === FALSE) {
        throw new Exception("TRIGGER CREATION FAILED: " . $conn->error);
    }

    SUCCESS_MESSAGE("TRIGGERS CREATED SUCCESSFULLY");
} catch (Exception $e) {
    ERROR_MESSAGE($e->getMessage());
}
