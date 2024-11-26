<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // include '../layout/header.php';
    // include '../../model/database.php';

    $database = new Database();
    $conn = $database->getConnection();

    $book_number = isset($_GET['id']) ? $_GET['id'] : '';

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     if (isset($_POST['category_name'])) {
    //         $newCatName = trim($_POST['category_name']);
    //         $query = "INSERT INTO `category`(`category_number`, `category_name`) VALUES (NULL,:category_name)";
    //         $stmt = $conn->prepare($query);
    //         $stmt->bindParam(':category_name', $newCatName);

    //         if ($stmt->execute()) {
    //             header("Location: ../../index.php?page=category");
    //             exit();
    //         }
    //     }
    // }
    $query = "SELECT * FROM book WHERE `book_number`=:book_number";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':book_number', $book_number);

    $stmt->execute();

    $book = $stmt->fetch();


    ?>
    <div>
        <h2>Edit Book</h2>
        <table>
            <tbody>
                <form action="" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td>

                            <label for="category_name">Category</label>

                        </td>
                        <td>

                            <?php
                            $query = "SELECT * FROM category";
                            $stmt = $conn->prepare($query);

                            $stmt->execute();

                            $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <select id="category_name" name="category_name">
                                <?php
                                foreach ($cats as $cat) { ?>
                                    <option value="<?php echo $cat["category_number"] ?>"
                                        <?php
                                        if ($book["cat_number"] == $cat["category_number"]) {
                                            echo "selected=\"selected\"";
                                        } ?>>
                                        <?php echo $cat["category_name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name">
                                Name:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="name"
                                name="book_name"
                                size='50'
                                value="<?php echo trim($book["book_name"]); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label for="author">Author</label>

                        </td>
                        <td>

                            <?php
                            $query = "SELECT * FROM author";
                            $stmt = $conn->prepare($query);

                            $stmt->execute();

                            $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <select id="author" name="author_id">
                                <?php
                                foreach ($authors as $author) { ?>
                                    <option value="<?php echo $author["author_code"] ?>"
                                        <?php
                                        if ($book["author_id"] == $author["author_code"]) {
                                            echo "selected=\"selected\"";
                                        } ?>><?php echo $author["author_name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="publisher">
                                Publisher:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="publisher"
                                name="publisher"
                                value=<?php echo trim($book["publisher"]); ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="year">
                                Year:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="year"
                                name="year"
                                value="<?php echo trim($book["year"]); ?>">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="price">
                                Price:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="price"
                                name="price"
                                value="<?php echo trim($book["price"]); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="image">
                                Image:
                            </label>
                        </td>
                        <td>
                            <input type="file" name="book_image" accept="image/*">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Edit" name="submit">
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>

    <?php

    ?>
</body>
<?php

$conn = null; ?>

</html>