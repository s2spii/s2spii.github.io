<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: /login/login.php');
    exit;
}
setcookie('weapons', '', 0);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="icon" type="image/png" href="/media/img/MafiaGG.png" />
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <header>
        <h1>Ventes d'armes</h1>
        <nav class="navbar">
            <li><a href="/index.php">Accueil</a></li>
            <li><a href="/pages/tarifs.php">Tarifs</a></li>
            <li><a href="/pages/contacts.php">Contacts</a></li>
            <li><a href="/login/logout.php">Déconnexion</a></li>
        </nav>
    </header>