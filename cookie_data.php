<?php
if (isset($_COOKIE['my_cart'])) {
    $cart_items = json_decode($_COOKIE['my_cart'], true);
    $json = json_encode($cart_items, JSON_UNESCAPED_UNICODE);

    echo $json;
}
