<?php session_start();

if (!isset($_SESSION['uid']) || !is_array($_SESSION['uid'])) {
    $_SESSION['uid'] = [];
}

if (!isset($_SESSION['uid']['cart']) || !is_array($_SESSION['uid']['cart'])) {
    $_SESSION['uid']['cart'] = [];
}

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

if (!empty($_POST['action'])) {
    $action = $_POST['action'];
}

if (empty($_GET['action']) && empty($_POST['action'])) {
    $action = 'show_cart';
}

switch ($action) {
    case 'details':
        include('product_details.php');
        break;
    case 'add':
        $bookID = filter_var($_POST['book_id'], FILTER_SANITIZE_NUMBER_INT);
        if (isset($_SESSION['uid']['cart'][$bookID])) {
            ?>
            <script>window.alert("That book is already in your cart")</script> <?php

        } else {
            require_once('../../../pdo_connect.php');
            $getBook = "SELECT * FROM ube_books WHERE book_id = ?";
            $stmt = $dbc->prepare($getBook);
            $stmt->bindParam(1, $bookID);
            $stmt->execute();
            $rows = $stmt->rowCount();
            if ($rows == 1) {
                $item = $stmt->fetch();
                $bookID = $item['book_id'];
                $bookTitle = $item['title'];
                $bookAuthor = $item['author'];
                $bookCondition = $item['cond'];
                $_SESSION['uid']['cart'][$bookID]['title'] = $bookTitle;
                $_SESSION['uid']['cart'][$bookID]['author'] = $bookAuthor;
                $_SESSION['uid']['cart'][$bookID]['cond'] = $bookCondition;
                $_SESSION['uid']['cart'][$bookID]['id'] = $bookID;
            } else {
                require '../includes/header.php';
                echo '<h2>We are unable to process your request at this time.</h2><h3>Please try again later.</h3>';
                exit;
            }
        }
        include('cart_view.php');
        break;
    case 'remove':
        $bookToRemove = $_POST['book_id'];
        unset($_SESSION['uid']['cart'][$bookToRemove]);
        include 'cart_view.php';
        break;
    case 'show_cart':
        include 'cart_view.php';
        break;
    case 'empty_cart';
        unset($_SESSION['uid']['cart']);
        include 'cart_view.php';
        break;
}