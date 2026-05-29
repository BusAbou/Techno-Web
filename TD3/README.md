# TD3 — Horloge SVG

> Réalisé par **SOW Mamadou Baillo**  
> Cours de Technologies Web — Université de Lille

## C'est quoi ce TD ?

Dans ce TD, on a créé une horloge analogique qui s'affiche en SVG dans le navigateur. L'idée c'est simple : l'utilisateur remplit un formulaire avec l'heure qu'il veut afficher, choisit les couleurs des aiguilles et du fond, et l'horloge s'affiche avec les aiguilles bien positionnées.

Toute la logique de validation des paramètres et le calcul des angles des aiguilles se font côté serveur en PHP.

## Comment ça marche ?

1. On ouvre `formHorloge.html` — il y a un formulaire avec les champs heures, minutes, secondes, couleur des aiguilles et couleur de fond. Il y a aussi une case à cocher "Transparent" pour le fond.
2. On soumet le formulaire → ça envoie les données en `GET` vers `horloge.php`.
3. PHP vérifie que les valeurs sont correctes. Si quelque chose cloche, on tombe sur une page d'erreur.
4. Si tout est bon, PHP calcule les angles des aiguilles et génère l'horloge SVG avec les bonnes rotations.

## Organisation des fichiers

```
TD3/
├── horloge.php          # Le script principal qui reçoit le formulaire
├── formHorloge.html     # Le formulaire de saisie
├── checkbox.js          # Gère l'activation/désactivation du champ couleur de fond
├── lib/
│   ├── fonctions_clock.php      # Calcule les angles des 3 aiguilles
│   ├── fonctions_parms.php      # Valide les paramètres GET (entier, couleur CSS)
│   ├── color_defs.php           # Liste de tous les mots-clés de couleurs CSS + regex hex
│   └── ParmsException.class.php # Exception déclenchée quand un paramètre est invalide
└── views/
    ├── page.php             # La page HTML qui contient l'horloge
    ├── clockComponent.php   # Le SVG de l'horloge avec les aiguilles animées par PHP
    └── pageErreur.html      # Page affichée si les paramètres sont incorrects
```

## Le calcul des angles

Pour positionner les aiguilles sur le cadran, on convertit le temps en degrés de rotation :

```
secondes → 6° par seconde
minutes  → 6° par minute  (+  un tout petit peu selon les secondes)
heures   → 30° par heure  (+  un peu selon les minutes et secondes)
```

C'est la fonction `angles()` dans `lib/fonctions_clock.php` qui fait ça.

## La validation des paramètres

On ne fait jamais confiance à ce qui vient du formulaire. Deux fonctions dans `lib/fonctions_parms.php` s'en occupent :

- `checkUnsignedInt()` — vérifie que la valeur est bien un entier positif
- `checkColor()` — vérifie que la couleur est soit un mot-clé CSS (`red`, `blue`...) soit un code hex (`#FF0000`), et gère aussi le cas `transparent`

Si un paramètre est invalide, une `ParmsException` est levée et on affiche la page d'erreur.

## Pour tester

```
http://<serveur>/TD3/formHorloge.html
```

Ou directement avec des paramètres dans l'URL :

```
http://<serveur>/TD3/horloge.php?hours=11&minutes=37&seconds=0&hands=blue
```

## Ce qu'on a appris

- Gérer un formulaire HTML et récupérer les données avec `$_GET`
- Valider et sécuriser les entrées utilisateur côté serveur
- Générer du SVG dynamiquement avec PHP
- Utiliser les exceptions pour gérer les erreurs proprement
- Un peu de JavaScript pour rendre le formulaire plus interactif
