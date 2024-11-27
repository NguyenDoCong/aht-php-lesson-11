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

    ?>
    <div>
        <h2>Add New Book</h2>
        <table>
            <tbody>
                <form action="" method="POST" enctype="multipart/form-data">
                    <tr>
                        <td>

                            <label for="cat_number">Category</label>

                        </td>
                        <td>

                            <?php
                            $query = "SELECT * FROM category";
                            $stmt = $conn->prepare($query);

                            $stmt->execute();

                            $cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <select id="cat_number" name="cat_number">
                                <?php
                                foreach ($cats as $cat) { 
                                    ?>
                                    <option value="<?php echo $cat["category_number"] ?>"><?php echo $cat["category_name"] ?></option>
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
                                name="book_name">
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label for="author_id">Author</label>

                        </td>
                        <td>

                            <?php
                            $query = "SELECT * FROM author";
                            $stmt = $conn->prepare($query);

                            $stmt->execute();

                            $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <select id="author_id" name="author_id">
                                <?php
                                foreach ($authors as $author) { ?>
                                    <option value="<?php echo $author["author_code"] ?>"><?php echo $author["author_name"] ?></option>
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
                                name="publisher">
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
                                name="year">
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
                                name="price">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="image">
                                Image:
                            </label>
                        </td>
                        <td>
                            <input type="file" name="image" accept="image/*" required><br>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Add" name="submit">
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