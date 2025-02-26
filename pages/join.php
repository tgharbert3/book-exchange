<!-- Tyler Harbert -->

<?php require("../includes/header.php"); ?>


<?php
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $missing['username'] = "Username is required";
    }

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        $missing["email"] = "Email is required";
    }

    if (!empty($_POST["password"])) {
        $password = $_POST['password'];
    } else {
        $missing["password"] = "A password is required";
    }

    if (!empty($_POST["verify-password"])) {
        $verify_password = $_POST['verify-password'];

    } else {
        $missing["verify-password"] = "Verify Password is required";
    }

    if ($password !== $verify_password) {
        $missing['not_matching'] = "Passwords do not match";
    }
}
?>

<aside>
    <ul>
        <li>Home</li>
        <li>Join</li>
    </ul>
</aside>
<section class="container">

    <h2>Join us at Used Book Exchange:</h2>
    <h4>Please enter the following information: </h4>
    <form method="POST" action="./join.php">
        <?php if (isset($missing)) {
            echo "<h3>Please fix the following: </h3>";
        }

        ?>
        <div class="username">
            <?php
            if (!empty($missing['username'])) {
                echo '<span>' . $missing['username'] . '</span>';
            }
            ?>
            <label for="username">Username: </label>
            <input required id="username" name="username" <?php
            if (isset($username) && !empty($missing['not_matching'])) {
                echo ' value= "' . htmlspecialchars($username) . '"';
            }
            ?>>

        </div>
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
        <div class="verify-password">
            <?php
            if (!empty($missing['email'])) {
                echo '<span>' . $missing['verify-password'] . '</span>';
            }
            ?>
            <label for="verify-password">Verify Password: </label>
            <input type="password" id="verify-password" name="verify-password" required>
        </div>
        <?php
        if (!empty($missing['not_matching'])) {
            echo '<span>' . $missing['not_matching'] . '</span>';
        }
        ?>
        <div class="buttons">
            <button type="submit" name="submit" value="submit">Join</button>
            <button type="reset" name="reset" value="reset">Reset</button>
        </div>
    </form>

</section>

<?php require("../includes/footer.php");