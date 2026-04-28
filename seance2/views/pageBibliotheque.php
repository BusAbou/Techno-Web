<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>
    <link rel="stylesheet" href="styles.css"> <!-- Inclure votre feuille de style si nécessaire -->
</head>
<body>
    <header>
        <h1>Ma Bibliothèque</h1>
    </header>
    
    <main>
        <section>
            <?php
            // Vérifiez si $libraryHTML est défini et non vide
            if (isset($libraryHTML) && !empty($libraryHTML)) {
                echo $libraryHTML; // Affichez le contenu des livres
            } else {
                echo '<p>Aucun livre disponible.</p>'; // Message par défaut si aucun livre n'est trouvé
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Ma Bibliothèque</p>
    </footer>
</body>
</html>