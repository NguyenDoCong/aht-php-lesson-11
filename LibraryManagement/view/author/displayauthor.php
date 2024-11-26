<?php
// include 'model/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
        $author_code = $_GET['id'];
        $query = "DELETE FROM `author` WHERE `author_code ` = :author_code ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':author_code', $author_code);

        $stmt->execute();
    }
}

$query = "SELECT * FROM author";
$stmt = $conn->prepare($query);

$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>author List</h2>

<table>
    <thead>
        <tr>
            <th>
                Code
            </th>
            <th>
                Author Name
            </th>
            <th>
                Description
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
            foreach ($categories as $author) {
        ?>
                <tr>
                    <td>
                        <?php
                        echo "C0" . $author["author_code"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $author["author_name"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $author["description"];
                        ?>
                    </td>
                    <td>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($author["image"]); ?>" />

                    </td>
                    <td>
                        <a href="view/author/editauthor.php?id=<?php echo $author['author_code']; ?>">Update</a>
                        <span>|</span>
                        <a href="view/author/deleteauthor.php?id=<?php echo $author['author_code']; ?>">Delete</a>


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
<a href="view/author/addauthor.php">
    Add new author
</a>
<?php

$conn = null;
