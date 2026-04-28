<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Premier exercice PHP</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="iniPHP.css" />
    </head>
    <body>
        <header>
            <h1>Premier exercice PHP</h1>
            <h2>Réalisé par <span class="nom">SOW Mamadou Baillo</span></h2>
        </header>
        <!-- section résultat. Créer une section pour chaque question -->
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p>Nous sommes le <?= date('d / m / Y') ?></p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p>Les valeurs des variables sont: <?= afficheVar(12,"je suis une chaine")?></p>
        </section>
        <section>
            <h2>Question<?= $num_quest++ ?></h2>
            <p><?= n_parag("PHP", 4)?></p>
        </section>
        <section>
            <h2>Question<?= $num_quest++ ?></h2>
            <p>1 - texteTronque: <?= paragrapheTronque("Ceci est un long texte qui sera tronqué.", 17)?></p>
            <p>2 - Diminue: <?= diminue("Diminuer")?></p>
        </section>
        <section>
            <h2>Question<?= $num_quest++ ?></h2>
            <p><?= multiplication(2,1)?></p>
        </section>
        <section>
            <h2>Question<?= $num_quest++ ?></h2>
            <p><?= tableMultiplication(2,9)?></p>
        </section>
        <section>
            <h2>Question<?= $num_quest++ ?></h2>
            <p>
                table de multiplication de 1 à 9
                <?= tablesMultiplications()?>
            </p>
        </section>
        <section>
            <h2>Question<?= $num_quest++ ?></h2>
            <p><?= tableauMult()?></p>
        </section>
        <section>
           <h2>Question<?= $num_quest++ ?></h2>
           <pre><?= htmlspecialchars(formatString("Et qu'on sorte+ Vistement : +Car Clément + Le vous mande.")) ?></pre>
        </section>
        <section>
           <h2>Question<?= $num_quest++ ?></h2>
           <pre><?= htmlspecialchars(enSpan("Dupont - Durand")) ?></pre>
        </section>
    </body>
    
</html>