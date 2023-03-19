<?php session_start();

$password = [
    "Mafia Gallia" => "mgdz",
    "BMF" => "bmfaz",
    "GMF" => "GMK"
];

if (!isset($_POST['password'])) {

    exit('Merci de remplir le mot de passe');
}

foreach ($password as $name => $pass) {

    $found = false;
    if ($_POST['password'] == $pass) {

        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id;
        $found = true;
        header('Location: /');
        break;
    }

    if (!$found) {
        header('Location: login.php');
    }
}
