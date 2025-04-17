<?php session_start();
require '../includes/header.php';

if (isset($_POST['submit']) && $_POST['submit'] == "Add Book") {
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['cond'])) {
        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $condition = trim($_POST['cond']);

        require_once '../../../pdo_connect.php';
        $insert = "INSERT INTO ube_books(uid, title, author, cond) VALUES(?,?,?,?)";
        $stmt = $dbc->prepare($insert);
        $stmt->bindParam(1, $_SESSION['uid']);
        $stmt->bindParam(2, $title);
        $stmt->bindParam(3, $author);
        $stmt->bindParam(4, $condition);
        $stmt->execute();
        $numRows = $stmt->rowCount();
        if ($numRows == 1) {
            echo '<section style="text-align:center";>' . "
                You Sucessfully uploaded: <br />
                Title: $title <br />
                Author: $author <br />
                Condition: $condition <br />
            </section>";
        }
    }
    include '../includes/footer.php';
    exit;
}

if (isset($_POST['submit']) && $_POST['submit'] == "Delete") {
    require_once '../../../pdo_connect.php';
    $BookID = trim($_POST['book_id']);
    $Delete = 'DELETE FROM ube_books WHERE book_id = ?';
    $stmt = $dbc->prepare($Delete);
    $stmt->bindParam(1, $BookID);
    $stmt->execute();
    $numRows = $stmt->rowCount();
    if ($numRows == 1) {
       echo '<section style="text-align:center">' . "You succesfully removed a book from your list</section>"; 
    }
    include '../includes/footer.php';
    exit;
}
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
                <input type="text" name="title" id="title" required>
            </div>
            <br />
            <div class="input">
                <label for="author">Author: </label>
                <input type="text" name="author" id="author" required>
            </div>
            <br />
            <div class="input">
                <label for="cond">Condition: </label>
                <input type="text" name="cond" id="cond" required>
            </div>
            <br />
            <input type="submit" name="submit" value="Add Book" class="input" style="width: 10%; margin-left: 45%">

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
                        <form action="book_upload.php" method="POST">
                            <input type="submit" name="submit" value="Delete">
                            <input type="hidden" name="book_id" value="<?=$bookID ?>">
                        </form>
                    </div>
                </li>
                <?php } ?>
            </ul> 
    </div>
</section>

<?php include '../includes/footer.php'; ?>