<?php session_start();
require '../includes/header.php';
//possible use hidden input to add/delete
?>

<?php
require_once '../../../pdo_connect.php';

$user_id = $_SESSION['uid'];
$sql = "SELECT * FROM ube_books WHERE uid = $user_id";
$result = $dbc->query($sql);
?>

<section>
    <div class="upload">
        <div class="section_header">
            Upload Book
        </div>
        <form action="book_upload.php" method="POST" class="upload">
            <div class="input">
                <label for="title">Title: </label>
                <input type="text" name="title" id="title">
            </div>
            <br />
            <div class="input">
                <label for="author">Author: </label>
                <input type="text" name="author" id="author">
            </div>
            <br />
            <div class="input">
                <label for="cond">Condition: </label>
                <input type="text" name="cond" id="cond">
            </div>
            <br />
            <input type="submit" name="submit" value="Add Book" class="input" style="width: 10%; margin-left: 45%">
            <input type="hidden" name="action" value="add">
        </form>
    </div>
    <div class="view">
        <div class="section_header">
            My Listed Books
        </div>
        <ul class="book_list">
            <?php foreach ($result as $row) {
                $title = $row['title'];
                $author = $row['author'];
                $condition = $row['cond'];
                $bookID = $row['book_id'];
                ?>
                <li>
                    <div class="list_label">Author:</div> <?= $author ?>
                    <br />
                    <div class="list_label">Title:</div> <?= $title ?>
                    <br />
                    <div class="list_label">Condition: </div><?= $condition ?>
                    <div>
                        <input type="submit" name="submit" value="Delete">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="book_id" value=<?= $bookID; ?>>
                    </div>
                </li>

                <br />
            <?php } ?>
        </ul>
    </div>
    <br>

</section>

<?php include '../includes/footer.php'; ?>