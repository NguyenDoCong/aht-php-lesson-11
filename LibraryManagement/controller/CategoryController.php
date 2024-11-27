<?php
include './model/CategoryDB.php';

use Model\CategoryDB;

class CategoryController
{
    public $CategoryDB;

    public function addcategory()
    {
        $database = new Database();
        // $conn = $database->getConnection();
        $this->CategoryDB = new CategoryDB($database->getConnection());
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['category_name'])) {
                $newCatName = trim($_POST['category_name']);
                $this->CategoryDB->addcategory($newCatName);

                // if ($stmt->execute()) {
                header("Location: ./index.php?page=category");
                //     exit();
                // }
            }
        } else {
            include 'view/category/addcategory.php';
        }
    }
}
