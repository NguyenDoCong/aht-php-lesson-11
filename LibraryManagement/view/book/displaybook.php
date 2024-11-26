<?php
// include 'model/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
        $book_number = $_GET['id'];
        $query = "DELETE FROM `book` WHERE `book_number ` = :book_number ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':book_number', $book_number);

        $stmt->execute();
    }
}

$query = "SELECT * FROM book";
$stmt = $conn->prepare($query);

$stmt->execute();

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h2>book List</h2>

<table>
    <thead>
        <tr>
            <th>
                Code
            </th>
            <th>
                Book Name
            </th>
            <th>
                Publisher
            </th>
            <th>
                Author
            </th>
            <th>
                Category
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
        if (count($books) > 0) {
            foreach ($books as $book) {
        ?>
                <tr>
                    <td>
                        <?php
                        echo "C0" . $book["book_number"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $book["book_name"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $book["publisher"];
                        ?>
                    </td>
                    <td>
                        <?php
                        $query = "SELECT `author_name` FROM `book`, `author` WHERE ?=`author`.`author_code`;";
                        $stmt = $conn->prepare($query);
                        $author_id = $book["author_id"];
                        $stmt->bindParam(1, $author_id);

                        $stmt->execute();

                        $author = $stmt->fetch();
                        echo $author["author_name"];
                        ?>
                    </td>
                    <td>
                        <?php
                        $query = "SELECT `category_name` FROM `book`, `category` WHERE ?=`category`.`category_number`;";
                        $stmt = $conn->prepare($query);
                        $book_cat = $book["cat_number"];
                        $stmt->bindParam(1, $book_cat);

                        $stmt->execute();

                        $cat = $stmt->fetch();
                        echo $cat["category_name"];
                        ?>
                    </td>
                    <td>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($book["image"]); ?>" />
                    </td>
                    <td>
                        <a href="index.php?page=editbook&id=<?php echo $book['book_number']; ?>">Update</a>
                        <span>|</span>
                        <a href="view/book/deletebook.php?id=<?php echo $book['book_number']; ?>">Delete</a>


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
<a href="index.php?page=addbook">
    Add new book
</a>
<?php

$conn = null;
