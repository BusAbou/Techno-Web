<?php /*
   Licence Informatique Université de Lille

   Assert : Une variable globale nommée $table_regions contient le code d'une table HTML
*/?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Régions - formulaire</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="styles/regions.css" />
    </head>
    <body>
        <header>
            <h1>Chercher des departements</h1>
        </header>
        <!--
            A compléter avec le formulaire
        -->
        <form action="departements.php" method="get">
            <label for="reg">Région : </label>
            <select id="reg" name="reg">
                <option value="">Toutes</option>
                <?php echo $options_regions; ?>
            </select>
            <input type="submit" value="Envoyer">
        </form>
    </body>
</html>
