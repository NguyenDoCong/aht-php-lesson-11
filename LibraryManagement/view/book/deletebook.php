<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php


    ?>
    <div>
        <h2>Delete book</h2>
        <p>Do you want to delete book "<?php echo htmlspecialchars($book["book_name"]); ?>"?</p>

        <div>
            <form action="" method="post" style="display: inline;">
                <input type="hidden" name="bookid" value="<?php echo ($book["book_number"]); ?>">
                <input type="submit" name="delete" value="Delete">
            </form>

            <a href="../../index.php" style="margin-left: 10px;">Cancel</a>
        </div>
    </div>

    <?php

    ?>
</body>
<?php
$conn = null; ?>

</html>