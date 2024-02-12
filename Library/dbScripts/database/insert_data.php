<?php
include('connect.php');

try {
    $conn_db = $conn->select_db(DATABASE_NAME);

    if (!$conn_db) {
        throw new Exception("DATABASE SELECTION FAILED: " . $conn->error);
    }

    // Adding 2 users
    $queryUsers = "
    INSERT INTO users(firstName, lastName, email, address, age, phoneNumber, interests, password, role)
    VALUES 
    ('mohamad', 'alwan', 'alwan.mohamad@gmail.com', 'Beirut', 20, '81968625', 'History', 'mohamadPP', 'user'),
    ('mustafa', 'almheimid', 'mustafa@hotmail.com', 'Beirut', 20, '76889762', 'Coding', 'adminPP', 'admin');
    ";

    if ($conn->multi_query($queryUsers) === FALSE) {
        throw new Exception("USERS INSERTION FAILED: " . $conn->error);
    }

    while ($conn->more_results()) {
        $conn->next_result();
    }

    // Adding 3 books with links to photos
    $queryBooks = "
    INSERT INTO books(isbn, title, authorName, pagesNumber, category, publicationDate, language, publisher, description, isAvailable, cover, nbOfCopies, price)
    VALUES 
    ('9780359727896', 'Rich Dad Poor Dad - What the Rich Teach Their Kids About Money', 'Robert T. Kiyosaki', 196, '', '', 'en', 'Lulu.com', 'None', 1, 'http://books.google.com/books/content?id=kRqeDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1, 0),
    ('9781476642390', 'Adapting Superman', 'John Darowski', 288, 'Literary Criticism', '2021-05-29', 'en', 'McFarland', 'Almost immediately after his first appearance in comic books in June 1938, Superman began to be adapted to other media. The subsequent decades have brought even more adaptations of the Man of Steel, his friends, family, and enemies in film, television, comic strip, radio, novels, video games, and even a musical. The rapid adaptation of the Man of Steel occurred before the character and storyworld were fully developed on the comic book page, allowing the adaptations an unprecedented level of freedom and adaptability. The essays in this collection provide specific insight into the practice of adapting Superman from comic books to other media and cultural contexts through a variety of methods, including social, economic, and political contexts. Authors touch on subjects such as the different international receptions to the characters, the evolution of both Clark Kent\\'s character and Superman\\'s powers, the importance of the radio, how the adaptations interact with issues such as racism a', 1, 'http://books.google.com/books/content?id=WoMwEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1, 0),
    ('9781476730776', 'A Curious Mind', 'Brian Grazer', 320, 'Biography & Autobiography', '2016-04-26', 'en', 'Simon and Schuster', '\"Brian Grazer knows the one thing that can instantly connect you with anyone: Curiosity. A Curious mind offers a brilliantly entertaining and inspiring account of how his courage and enthusiasm for talking with complete strangers have been the secret of his success as a leading Hollywood producer.\"--Publisher\\'s description.', 0, 'http://books.google.com/books/content?id=B08ADAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 0, 0);
    ";

    if ($conn->multi_query($queryBooks) === FALSE) {
        throw new Exception("BOOKS INSERTION FAILED: " . $conn->error);
    }

    while ($conn->more_results()) {
        $conn->next_result();
    }

    SUCCESS_MESSAGE("USERS AND BOOKS INSERTED SUCCESSFULLY");
} catch (Exception $e) {
    ERROR_MESSAGE($e->getMessage());
}
