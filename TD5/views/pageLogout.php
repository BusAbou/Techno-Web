<?php
session_start(); // Démarrer la session
session_destroy(); // Détruire toutes les données de session

// Afficher un message ou rediriger
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8"/>
    <title>Déconnexion</title>
</head>
<body>
    <p>Vous êtes déconnecté.</p>
    <p><a href="index.php">Retour à la page principale</a></p>
</body>
</html>