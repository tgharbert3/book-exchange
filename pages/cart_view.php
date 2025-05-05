<?php session_start(); ?>
<?php require '../includes/header.php'; ?>

<?php

if (!isset($_SESSION['uid']['cart']) || empty($_SESSION['uid']['cart'])) {
    ?>
    <section class="container">
        <h2 class="no_product">There are no products in your cart.</h2>
        <h3 class="no_product">Please use the search to shop.</h3>
        <?php include '../includes/footer.php'; ?>
    </section>
    <?php
} else {
    ?>
    <section class="container">
        <h2 style="text-align: center;">Your Cart</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="margin: auto;">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Condition</th>
                <th>Update</th>
            </tr>
            <?php foreach ($_SESSION['uid']['cart'] as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['cond']) ?></td>
                    <td>
                        <form action="cart.php" method="POST">
                            <input type="submit" name="remove" value="Remove">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="book_id" value="<?= $book['id']; ?>">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="search.php?type=title">Add Another Book</a></p>
        <p><a href="cart.php?action=empty_cart">Empty Cart</a></p>
        <p>Proceed to: <a href="#">Checkout</a></p>
    </section>

    <?php
    include '../includes/footer.php';
} ?>