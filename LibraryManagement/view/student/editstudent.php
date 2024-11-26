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
            $query = "UPDATE student SET student_name = :student_name WHERE student_number = :student_number";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':student_name', $newCatName);
            $stmt->bindParam(':student_number', $student_number);

            $stmt->execute();
        }
    }

    $query = "SELECT student_name FROM student WHERE student_number = :student_number";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':student_number', $student_number);

    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    <div>
        <h2>Edit student</h2>
        <table>
            <tbody>
                <form action="" method="post">
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
                                name="student_name"
                                value="<?php echo $student["student_name"]; ?>">

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update">
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