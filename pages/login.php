<!-- Name: Tyler Harbert -->
<?php session_start(); ?>
<?php require("../../secure_conn.php"); ?>
<?php require '../includes/header.php' ?>
<?php

if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {

    $valid_email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    if (empty($_POST["email"])) {
        $missing["email"] = "Email is required";
    } elseif (!$valid_email) {
        $missing["email"] = "Please enter a valid email";
    } else {
        $email = $valid_email;
    }

    if (!empty($_POST["password"])) {
        $password = trim($_POST['password']);
    } else {
        $missing["password"] = "A password is required";
    }

    try {

        require_once('../../../pdo_connect.php'); // Connect to the db.
        //Query for email
        $sql = "SELECT * FROM ube_users WHERE email = :email";
        $stmt = $dbc->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $numRows = $stmt->rowCount();
        if ($numRows == 0)
            $missing['no_email'] = "That email address wasn't found";
        else { // email found, validate password
            $result = $stmt->fetch(); //convert the result object pointer to an associative array 
            $pw_hash = $result['pword'];
            if (password_verify($password, $pw_hash)) { //passwords match
                //your code here
                session_start();
                $_SESSION['logged_in'] = 'logged_in';
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $result['username'];
                $_SESSION['uid'] = $result['user_id'];
                $_SESSION['user_id'] = $result['user_id'];
                header('Location: ./home.php');
                exit;
            } else {
                $errors['wrong_pw'] = "That isn't the correct password";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<aside>
    <ul>
        <li>Home</li>
        <li>Login</li>
    </ul>
</aside>
<section class="container">

    <h2>Join us at Used Book Exchange:</h2>
    <h4>Please enter the following information: </h4>
    <form method="POST" action="./login.php">
        <?php if (isset($missing)) {
            echo "<h3>Please fix the following: </h3>";
        }
        ?>
        <div class="email">
            <?php
            if (!empty($missing['email'])) {
                echo '<span>' . $missing['email'] . '</span>';
            }
            ?>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" required <?php
            if (isset($username) && !empty($missing['not_matching'])) {
                echo ' value= "' . htmlspecialchars($email) . '"';
            }
            ?>>
        </div>
        <div class="password">
            <?php
            if (!empty($missing['email'])) {
                echo '<span>' . $missing['password'] . '</span>';
            }
            ?>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="buttons">
            <button type="submit" name="submit" value="submit">Login</button>
            <button type="reset" name="reset" value="reset">Reset</button>
        </div>
    </form>

</section>
<?php include("../includes/footer.php") ?>