<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Book Exchange</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']);

    if ($currentPage == 'login.php' || $currentPage == 'join.php' || $currentPage == 'logged_out.php') {
        echo "<link rel='stylesheet' href='../styles/main.css'>";
    } elseif ($currentPage == 'profile.php') {
        echo "<link rel='stylesheet' href='../styles/profile.css'>";
    } elseif ($currentPage == 'book_upload.php') {
        echo "<link rel='stylesheet' href='../styles/book_upload.css'>";
    }
    ?>

    <link rel="stylesheet" href="../styles/nav.css">
</head>

<body>
    <header>
        <?php require("../includes/nav-bar.php") ?>
    </header>
    <main>