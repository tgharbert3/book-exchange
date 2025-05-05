<!-- Name: Tyler Harbert -->

<?php session_start() ?>
<?php require("../../reg_conn.php"); ?>
<?php require("../includes/header.php"); ?>
<aside>
    <ul>
        <li>Home</li>
        <li>Search</li>
    </ul>
</aside>
<div class="search_header">
    <ul>
        <li>
            <h4 style="border-left: 1px solid black;"><a href="../pages/search.php?type=title">Search by Title</a>
            </h4>
        </li>
        <li>
            <h4><a href="../pages/search.php?type=author">Search by Author</a></h4>
        </li>
        <li>
            <h4><a href="../pages/search.php?type=cond">Search by Condition</a></h4>
        </li>
    </ul>
</div>
<section class="container">
    <h2>Search For Books</h2>
    <form method="POST" action="search.php?type=<?= $_GET['type'] ?>">
        <label for="search">
            <?php
            if ($_GET['type'] == 'title') {
                echo 'Title: ';
            } elseif ($_GET['type'] == 'author') {
                echo 'Author: ';
            } elseif ($_GET['type'] == 'cond') {
                echo 'Condition: ';
            }
            ?></label>
        <input type="text" placeholder="Search" name="search" class="search_bar">
        <input type="submit" name="submit" value="Search" id="submit">
    </form>

    <?php
    if (isset($_POST['submit']) && $_POST['submit'] == 'Search') {

        $type = $_GET['type'];
        require_once '../../../pdo_connect.php';
        $sql = "SELECT * from ube_books WHERE $type = ?";
        $stmt = $dbc->prepare($sql);
        $stmt->bindParam(1, $_POST['search']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $numRows = $stmt->rowCount();
    }

    if (!$result) {

        if ($_GET['type'] == 'title') {
            echo '<p style="text-align:center; margin-top:0;">Example Search: Outlander</p>';
        }
        if ($_GET['type'] == 'author') {
            echo '<p style="text-align:center; margin-top:0;">Example Search: Rebecca Yarros</p>';
        }

        if ($_GET['type'] == 'cond') {
            echo '<p style="text-align:center; margin-top:0;">Conditions: New, Like New, Very Good, Good, Acceptable, Poor</p>';
        }

        if ($numRows <= 0 && isset($_POST['submit'])) {
            echo "<p> No results found </p>";
        }
    }

    if ($result) {
        echo '<h3> Results: </h3>';
        if (!$_SESSION['username']) {
            echo '<p style="margin-left: 3%; margin-bottom: 0; font-weight: bold;">Must be signed in to exchange books</p>';

        }
        ?>
        <section class="results">
            <ul>
                <?php
                if ($numRows == 1) {
                    ?>
                    <li>
                        <?php
                        foreach ($result as $row) {
                            echo "Title: " . $row['title'] . "</br> Author: " . $row['author'] . "</br> Condition: " . $row['cond'];
                        } ?>
                        <?php if ($_SESSION['username']) { ?>
                            <form action="cart.php" method="POST">
                                <input type="submit" name="cart" value="Add to Cart">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>">
                            </form>
                        <?php } ?>
                    </li>
                <?php }
                ?>
                <?php if ($numRows > 1) {
                    ?>
                    <li>
                        <?php foreach ($result as $row) {
                            echo "Title: " . $row['title'] . "</br> Author: " . $row['author'] . "</br> Condition: " . $row['cond'] . "</br>"; ?>
                            <?php if ($_SESSION['username']) { ?>
                                <form action="cart.php" method="POST">
                                    <input type="submit" name="cart" value="Add to Cart">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="book_id" value="<?= $row['book_id'] ?>">
                                </form>
                            <?php } else {
                                echo '</br>';
                            } ?>
                        <?php } ?>

                    </li>
                <?php } ?>
            </ul>
        </section>
    <?php } ?>
</section>
<footer>
    <?php include("../includes/footer.php") ?>
</footer>