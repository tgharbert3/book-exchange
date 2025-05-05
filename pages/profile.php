<?php
session_start();
//TODO
//Add styling
require '../includes/header.php';
if (isset($_SESSION['email'])) {
    require_once '../../../pdo_connect.php';
    $sql = "SELECT * FROM ube_users WHERE email = :emailaddr";
    $stmt = $dbc->prepare($sql);
    $stmt->bindParam(':emailaddr', $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->fetch();
    $username = $result['username'];
    $email = $result['email'];

    if (isset($_POST['Submit']) && $_POST['Submit'] == 'Submit') {
        $error = array();

        if (!empty($_POST['newUsername'])) {
            $newUsername = $_POST['newUsername'];
            require_once '../../../pdo_connect.php';
            //TODO: 
            //Check to make sure the username is unqiue by
            $sql2 = "UPDATE ube_users SET username = ? WHERE email = ?";
            $stmt2 = $dbc->prepare($sql2);
            $stmt2->bindParam(1, $newUsername);
            $stmt2->bindParam(2, $email);
            $stmt2->execute();
            $numRows = $stmt2->rowCount();
            if ($numRows != 1) {
                echo "Unable to update username";
            } else {
                $sql = "SELECT * FROM ube_users WHERE email = :emailaddr";
                $stmt = $dbc->prepare($sql);
                $stmt->bindParam(':emailaddr', $_SESSION['email']);
                $stmt->execute();
                $result = $stmt->fetch();
                $username = $result['username'];
            }

        }

        if (!empty($_POST['newEmail'])) {
            $newEmail = $_POST['newEmail'];
            require_once '../../../pdo_connect.php';
            $sql3 = "UPDATE ube_users SET email = ? WHERE username = ?";
            //TODO: 
            //Check to make sure the email is unqiue by
            $stmt3 = $dbc->prepare($sql3);
            $stmt3->bindParam(1, $newEmail);
            $stmt3->bindParam(2, $username);
            $stmt3->execute();
            $numRows2 = $stmt3->rowCount();
        }
    }
} else {
    echo "You reached this page in error. Please login or register account.";
}

?>
<section class="container">
    <form action="profile.php" method="POST">
        <h2>Update Information: </h2>
        <label for="newUsername" class="username">Username: </label>
        <input type="text" name="newUsername" class="username">
        <br>
        <label for="newEmail" class="email">Email: </label>
        <input type="text" name="newEmail" class="email">
        <br>
        <input type="submit" name="Submit" id="submit">
    </form>
</section>


<?php
include '../includes/footer.php';
?>