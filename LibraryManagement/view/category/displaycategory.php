<?php
// include 'controller/CategoryController.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
        $category_number = $_GET['id'];
        $query = "DELETE FROM `category` WHERE `category_number` = :category_number";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':category_number', $category_number);

        $stmt->execute();
    }
}

$query = "SELECT * FROM category";
$stmt = $conn->prepare($query);

$stmt->execute();

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Categories List</h2>

<table>
    <thead>
        <tr>
            <th>
                Code
            </th>
            <th>
                Category Name
            </th>
            <th>

            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($categories) > 0) {
            foreach ($categories as $category) {
        ?>
                <tr>
                    <td>
                        <?php
                        echo "C0" . $category["category_number"];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $category["category_name"];
                        ?>
                    </td>
                    <td>
                        <a href="view/category/editcategory.php?id=<?php echo $category['category_number']; ?>">Update</a>
                        <span>|</span>
                        <a href="view/category/deletecategory.php?id=<?php echo $category['category_number']; ?>">Delete</a>


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
<a href="index.php?page=addcategory">
    Add new category
</a>
<?php
$conn = null;
?>