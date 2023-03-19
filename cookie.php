<?php
if (isset($_POST['name']) && isset($_POST['price'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Vérifier si le cookie existe déjà
    if (isset($_COOKIE['my_cart'])) {
        $cart_items = json_decode($_COOKIE['my_cart'], true);
    } else {
        $cart_items = array();
    }

    if ($name != "Boites de munitions") {
        $found = false;
        foreach ($cart_items as $weapon => $value) {
            if ($value["name"] == $name) {
                $cart_items[$weapon]["quantity"] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart_items[] = ["name" => $name, "price" => $price, "quantity" => 1];
        }
    } else {
        $found = false;
        foreach ($cart_items as $weapon => $value) {
            if ($value['name'] == $name) {
                $cart_items[$weapon]["quantity"] += $_POST['quantity'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            $cart_items[] = ["name" => $name, "price" => $price, "quantity" => $_POST['quantity']];
        }
    }

    $json = json_encode($cart_items, JSON_UNESCAPED_UNICODE);


    // Convertir le tableau en chaîne JSON et stocker dans le cookie
    setcookie('my_cart', $json, 0);

    // Envoyer les données au format JSON
    header('Content-Type: application/json');
    echo $json;
}
