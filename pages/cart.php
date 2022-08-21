<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);

Template::header("Cart"); ?>

<!-- <div id="cart-product-details" hidden>
    <img src="" id="product-img" height="50" width="50">
    <p id="product-title">  </p>
    <p id="product-description">  </p>
    <p id="product-price">  </p>
</div> -->

<?php foreach ($products as $product) : ?>

    <article class="product">
        <img src="<?= $product->img_url ?>" height="75" width="75">
        <div class="title-price-cart">
            <b><?= $product->title ?></b>
            <?= $product->price ?> kr
        <!-- in med en delete knapp här -->
        </div>
    </article>

<?php endforeach; ?>
<?php if (count($products) > 0) : ?>

    <h3> Total: <?= $total_sum ?></h3>

    <?php if ($is_logged_in) : ?>
        <form action="/arthusen/scripts/post-place-order.php" method="post">
            <input class="btn" type="submit" value="Place order">
        </form>
    <?php else : ?>
        <a href="/arthusen/pages/login.php"> Login to place order </a>
    <?php endif; ?>
<?php else : ?>

<?php endif; ?>

<?php if (count($products) < 0) : ?>
    <a href="/arthusen/pages/products.php"> Cart is empty</a>
<?php endif; ?>

<?php Template::footer();


/* 
<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);

Template::header("Cart"); ?>

<div id="cart-product-details" hidden>
    <img src="" id="product-img" height="50" width="50">
    <p id="product-title">  </p>
    <p id="product-description">  </p>
    <p id="product-price">  </p>
</div>

<?php foreach ($products as $product) : ?>

<div>    
    <button data-id=" <?= $product->id ?>" class="show-product-details"> Show </button>
    <?= $product->title ?>
</div>

<?php 

endforeach; ?>

<?php if(): ?>

<?php endif; ?>



<?php
Template::footer(); 
 */