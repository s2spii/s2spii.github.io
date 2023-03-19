<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: /');
    exit;
} ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="icon" type="image/png" href="/icon.png" />
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css'>
</head>

<body>
    <div class="login">
        <h1>Bienvenue sur le site</h1>
        <form action="authenticate.php" method="post">
            <h2>Connexion</h2>
            <label for="password">Mot de passe</label>
            <div><input type="password" name="password"></div>
            <div><button type="submit"><i class="fa-solid fa-right-to-bracket"></i><span>Se Connecter</span></button>
            </div>
        </form>
    </div>
</body>

</html>