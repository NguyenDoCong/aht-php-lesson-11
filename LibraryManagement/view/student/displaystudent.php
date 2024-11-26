<?php
// include 'model/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
        $student_number = $_GET['id'];
        $query = "DELETE FROM `student` WHERE `student_number ` = :student_number ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':student_number', $student_number);

        $stmt->execute();
    }
}

$query = "SELECT * FROM student";
$stmt = $conn->prepare($query);

$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Student List</h2>

<table>
    <thead>
        <tr>
            <th>
                Code
            </th>
            <th>
                Student Name
            </th>
            <th>
                Email
            </th>
            <th>
                Address
            </th>
            <th>
                Phone Number
            </th>

            <th>
                Image
            </th>
            <th>

            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($categories) > 0) {
            foreach ($categories as $student) {
        ?>
                <tr>
                    <td>
                        <?php
                        echo "C0" . $student["student_number"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $student["student_name"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $student["email"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $student["address"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $student["phone_number"];
                        ?>
                    </td>
                    <td>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($student["image"]); ?>" />

                    </td>
                    <td>
                        <a href="view/student/editstudent.php?id=<?php echo $student['student_number']; ?>">Update</a>
                        <span>|</span>
                        <a href="view/student/deletestudent.php?id=<?php echo $student['student_number']; ?>">Delete</a>


                    </td>
                </tr>
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </tbody>
</table>
<a href="view/student/addstudent.php">
    Add new student
</a>
<?php

$conn = null;
