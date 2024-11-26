<?php

namespace Model;

class Book
{
    public $book_number;
    public $book_name;
    public $publisher;
    public $author_id;
    public $year;
    public $price;
    public $image;
    public $cat_number;

    public function __construct($book_name, $publisher, $author_id, $year, $price, $image, $cat_number)
    {
        $this->book_name = $book_name;
        $this->publisher = $publisher;
        $this->author_id = $author_id;
        $this->year = $year;
        $this->price = $price;
        $this->image = $image;
        $this->cat_number = $cat_number;
    }
}
