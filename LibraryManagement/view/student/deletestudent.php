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

    if (isset($_GET['action'])) {
        $query = "DELETE FROM `student` WHERE `student_number` = :student_number";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_number', $student_number);

        if ($stmt->execute()) {
            header("Location: ../../index.php?page=student");
            exit();
        }
    }

    $query = "SELECT student_name FROM student WHERE student_number = :student_number";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':student_number', $student_number);

    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
    <div>
        <h2>Delete student</h2>
        <p>Do you want to delete student "<?php echo htmlspecialchars($student["student_name"]); ?>"?</p>

        <div>
            <form action="" method="get" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($student_number); ?>">
                <input type="submit" name="action" value="Delete">
            </form>

            <a href="../../index.php?page=student" style="margin-left: 10px;">Cancel</a>
        </div>
    </div>

    <?php

    ?>
</body>
<?php
$conn = null; ?>

</html>