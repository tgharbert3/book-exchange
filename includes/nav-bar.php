<?php session_start() ?>

<ul class="nav">
    <div class="nav-left">
        <li><a href="../pages/home.php">Used Book Exchange</a></li>
    </div>
    <div class="nav-right">
        <li><a href="../pages/search.php">Search</a></li>
        <?php if (isset($_SESSION['logged_in'])) {
            echo '<li><a href="../pages/book_upload.php"';
            echo '> Add Book</a></li>';
            echo '<li><a href="../pages/profile.php"';
            echo '> Profile</a></li>';
            echo '<li><a href="../pages/logged_out.php"';
            echo '> Logout</a></li>';

        } ?>

        <?php if (!isset($_SESSION['logged_in'])) {
            echo '<li><a href="../pages/join.php"';
            echo '> Join</a></li>';

            echo '<li><a href="../pages/login.php"';
            echo '> Login</a></li>';
        } ?>
    </div>
</ul>