<?php

namespace Model;

use PDO;

class BookDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addbook($book)
    {

        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $query = "INSERT INTO `book`(`book_number`, `book_name`, `publisher`, `author_id`, `year`, `price`, `image`, `cat_number`) 
        VALUES (NULL,:book_name,:publisher,:author_id,:year,:price,:image,:cat_number)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':book_name', $book->book_name);
        $stmt->bindParam(':publisher', $book->publisher);
        $stmt->bindParam(':author_id', $book->author_id);
        $stmt->bindParam(':year', $book->year);
        $stmt->bindParam(':price', $book->price);
        $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(':cat_number', $book->cat_number);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function bookByID($id)
    {
        $query = "SELECT * FROM book WHERE `book_number`=:book_number";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':book_number', $id);

        $stmt->execute();

        return $stmt->fetch();
    }


    public function editbook($book)
    {
        $query = "UPDATE `book` SET `book_name`=:book_name,`publisher`=:publisher,`author_id`=:author_id,`year`=:year,`price`=:price,`image`=:image,`cat_number`=:cat_number WHERE `book_number`=:book_number";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':book_number', $book->book_number);
        $stmt->bindParam(':book_name', $book->book_name);
        $stmt->bindParam(':publisher', $book->publisher);
        $stmt->bindParam(':author_id', $book->author_id);
        $stmt->bindParam(':year', $book->year);
        $stmt->bindParam(':price', $book->price);
        $stmt->bindParam(':image', $book->image, PDO::PARAM_LOB);
        $stmt->bindParam(':cat_number', $book->cat_number);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
