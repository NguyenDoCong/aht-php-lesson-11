<?php
include './model/BookDB.php';
include './model/Book.php';

use Model\BookDB;
use Model\Book;

class BookController
{
    public $BookDB;

    public function addbook()
    {
        $database = new Database();
        // $conn = $database->getConnection();
        $this->BookDB = new BookDB($database->getConnection());
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['book_name'])) {

                $book_name = $_POST['book_name'];
                $publisher = $_POST['publisher'];
                $author_id = $_POST['author_id'];
                $year = $_POST['year'];
                $price = $_POST['price'];
                $image = $_FILES['image'];
                $cat_number = $_POST['cat_number'];
                $book = new Book($book_name, $publisher, $author_id, $year, $price, $image, $cat_number);


                if ($this->BookDB->addbook($book)) {
                    header("Location: ./index.php?page=book");
                    exit();
                }
            }
        } else {
            include 'view/book/addbook.php';
        }
    }

    public function deletebook($id)
    {
        $database = new Database();
        $this->BookDB = new BookDB($database->getConnection());
        $book = $this->BookDB->bookByID($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($this->BookDB->deletebook($id)) {
                header("Location: ./index.php?page=book");
                exit();
            }
        }

        include 'view/book/deletebook.php';
    }

    public function editbook($id)
    {
        $database = new Database();
        $this->BookDB = new BookDB($database->getConnection());
        $book = $this->BookDB->bookByID($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['author_id'])) {
                die("Thiếu dữ liệu đầu vào.");
            }

            if (isset($_POST['book_name'])) {
                $book_name = $_POST['book_name'];
            } else {
                $book_name = $book["book_name"];
            }
            if (isset($_POST['publisher'])) {
                $publisher = $_POST['publisher'];
            } else {
                $publisher = $book["publisher"];
            }
            if (isset($_POST['author_id'])) {
                $author_id = $_POST['author_id'];
            } else {
                $author_id = $book["author_id"];
            }
            if (isset($_POST['year'])) {
                $year = $_POST['year'];
            } else {
                $year = $book["year"];
            }
            if (isset($_POST['price'])) {
                $price = $_POST['price'];
            } else {
                $price = $book["price"];
            }
            if (isset($_FILES['image'])) {
                $image = file_get_contents($_FILES['image']['tmp_name']);
            } else {
                $image = $book["image"];
            }
            if (isset($_POST['cat_number'])) {
                $cat_number = $_POST['cat_number'];
            } else {
                $cat_number = $book["cat_number"];
            }
            $book = new Book($book_name, $publisher, $author_id, $year, $price, $image, $cat_number);
            $book->book_number = $id;

            if ($this->BookDB->editbook($book)) {
                header("Location: ./index.php?page=book");
                exit();
            }
        } else {
            include 'view/book/editbook.php';
        }
    }
}
