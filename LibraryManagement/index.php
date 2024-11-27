<?php
require "model/database.php";
require "controller/Controller.php";
require "controller/CategoryController.php";
require "controller/BookController.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a {
            text-decoration: none;
        }

        img {
            width: 100px;
            height: auto;
        }

        table,
        th,
        td {
            border: 1px solid;
        }

        table {
            border-collapse: collapse;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>

<body>
    <div>
        <div class="menu">
            <?php
            include 'view/layout/header.php';
            ?>
        </div>
        <div>
            <?php
            $page = $_GET['page'] ?? '';
            $controller = new Controller();
            $categoryController = new CategoryController();
            $BookController = new BookController();

            switch ($page) {
                case 'category':
                    $controller->category();
                    break;
                case 'addcategory':
                    $categoryController->addcategory();
                    break;
                case 'student':
                    $controller->student();
                    break;
                case 'author':
                    $controller->author();
                    break;
                case 'book':
                    $controller->book();
                    break;
                case 'addbook':
                    $BookController->addbook();
                    break;
                case 'editbook':
                    $id = $_GET['id'] ?? '';
                    $BookController->editbook($id);
                    break;
                case 'deletebook':
                    $id = $_GET['id'] ?? '';
                    $BookController->deletebook($id);
                    break;
                default:
                    echo "";
            }
            ?>

        </div>
    </div>
</body>

</html>