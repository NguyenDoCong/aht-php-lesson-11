<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include '../layout/header.php';
    include '../../model/database.php';

    $database = new Database();
    $conn = $database->getConnection();

    $student_number = isset($_GET['id']) ? $_GET['id'] : '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['student_name'])) {
            $newCatName = trim($_POST['student_name']);
            $query = "INSERT INTO `student`(`student_number`, `student_name`) VALUES (NULL,:student_name)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':student_name', $newCatName);

            if ($stmt->execute()) {
                header("Location: ../../index.php?page=student");
                exit();
            }
        }
    }

    ?>
    <div>
        <h2>Add New student</h2>
        <table>
            <tbody>
                <form action="" method="post">
                    <tr>
                        <td>
                            <label for="student_code">
                                Code:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="student_code"
                                name="student_code">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="student_name">
                                Student Name:
                            </label>
                        </td>
                        <td>

                            <input
                                type="text"
                                id="student_name"
                                name="student_name">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Add">
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