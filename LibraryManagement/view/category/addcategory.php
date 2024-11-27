<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // include './view/layout/header.php';

    ?>
    <div>
        <h2>Add New Category</h2>
        <table>
            <tbody>
                <form action="" method="POST">
                    <tr>
                        <td>
                            <label for="category_code">
                                Code:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="category_code"
                                name="category_code">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="category_name">
                                Category Name:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="category_name"
                                name="category_name">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Add" name="">
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