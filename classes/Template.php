<?php

require_once __DIR__ . "/User.php";
session_start();

class Template
{
    public static function header($title)
    {
        $is_logged_in = isset($_SESSION["user"]);
        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
        $is_admin = $is_logged_in && ($logged_in_user->role == "admin");

        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> <?= $title ?> - Startsida </title>
            <link rel="stylesheet" href="/arthusen/assets/style.css">
        </head>

        <body>
            <h1> <?= $title ?> </h1>

            <nav>
                <a href="/arthusen">Start</a>
                <a href="/arthusen/pages/products.php">Products</a>
                <a href="/arthusen/pages/cart.php">Cart(<?= $cart_count?>)</a>


                <?php if (!$is_logged_in) : ?>
                    <a href="/arthusen/pages/login.php">Login</a>
                    <a href="/arthusen/pages/register.php">Register</a>

                <?php elseif($is_admin): ?>
                    <a href="/arthusen/pages/admin.php">Admin area</a>
                <?php endif; ?>
            </nav>

            <?php if ($is_logged_in) : ?>
                <p>
                    <b>Logged in as:</b>
                    <?= $logged_in_user->username ?>

                   <!--  <form action="/shop/scripts/post-logout.php" method="post">
                        <input type="submit" value="Logout">
                    </form> -->
                </p>
            <?php endif; ?>
            <hr>

        <?php }


    public static function footer()
    {

        ?>
            <footer>
                Copyright ARThusen 2020
            </footer>

            <!-- <script src="/shop/assets/script.js"></script> -->
        </body>

        </html>
<?php }
}