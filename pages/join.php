<!-- Tyler Harbert -->

<?php require("../includes/header.php"); ?>

<section class="container">
    <h2>Join us at Used Book Exchange:</h2>
    <h4>Please enter the following information: </h4>
    <form method="GET" action="./join.php">
        <div class="username">
            <label>Username: </label>
            <input required>

        </div>
        <div class="email">
            <label>Email: </label>
            <input type="email" required>
        </div>
        <div class="password">
            <label>Password: </label>
            <input type="password" required>
        </div>
        <div class="verify-password">
            <label>Verify Password: </label>
            <input type="password" required>
        </div>
        <div class="buttons">
            <button type="submit">Join</button>
            <button type="reset">Reset</button>
        </div>
    </form>

</section>

<?php require("../includes/footer.php");