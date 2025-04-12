<?php
session_start();
$email = $_SESSION['email'];
$username = $_SESSION['username'];
require '../includes/header.php';
echo "<h1>$username</h1>";
?>



<?php
include '../includes/footer.php';
?>