<?php

namespace Model;

class CategoryDB
{
    public $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addcategory($newCatName)
    {
        $query = "INSERT INTO `category`(`category_number`, `category_name`) VALUES (NULL,:category_name)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':category_name', $newCatName);
        $stmt->execute();
    }
}
