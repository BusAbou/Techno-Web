# Séance 1 — Introduction à PHP

> Réalisé par **Aboubacrin Simpara**  
> Cours de Technologies Web — Université de Lille

## Objectif

Prise en main de PHP : création de fonctions, manipulation de chaînes de caractères, génération de HTML dynamique, et affichage de tables de multiplication.

## Structure du projet

```
seance1/
├── iniPHP.php          # Point d'entrée — initialisation et inclusion
├── iniPHP.css          # Feuille de style
├── lib/
│   ├── fonctions_1.php # Fonctions PHP développées pour les exercices
│   └── .htaccess       # Protection du dossier lib/
└── views/
    ├── page_1.php      # Vue HTML — affichage des résultats par question
    └── .htaccess       # Protection du dossier views/
```

## Fonctions développées

| Fonction | Description |
|----------|-------------|
| `afficheVar(int $n, string $s)` | Retourne une chaîne affichant la valeur d'un entier et d'une chaîne |
| `n_parag(string $texte, int $nb)` | Génère `$nb` paragraphes HTML contenant `$texte` |
| `paragrapheTronque(string $s, int $i)` | Retourne un `<p>` avec les `$i` premiers caractères de `$s` |
| `diminue(string $chaine)` | Génère des paragraphes en réduisant progressivement la chaîne |
| `multiplication(int $n1, int $n2)` | Retourne le résultat de `n1 × n2` dans une liste HTML |
| `tableMultiplication(int $n1, int $n2)` | Génère la table de multiplication de `$n1` jusqu'à `$n2` |
| `tablesMultiplications()` | Génère toutes les tables de 1 à 9 sous forme de listes imbriquées |
| `tableauMult()` | Génère un tableau HTML `<table>` des multiplications de 1×1 à 9×9 |
| `formatString(string $input)` | Découpe une chaîne sur `+`, nettoie les espaces, et entoure chaque partie d'un `<p>` |
| `enSpan(string $s)` | Découpe une chaîne sur ` - ` et entoure chaque partie d'un `<span>` |

## Lancement

Déposer le dossier sur un serveur PHP (ex. Apache/XAMPP ou serveur universitaire) et accéder à :

```
http://<serveur>/seance1/iniPHP.php
```

## Notions abordées

- Syntaxe de base PHP (variables, boucles, fonctions)
- Typage des paramètres et valeurs de retour
- Génération de HTML depuis PHP (`echo`, `<?= ?>`)
- Manipulation de chaînes (`substr`, `strlen`, `explode`, `implode`, `array_map`, `trim`)
- Séparation du code en couches : logique (`lib/`) et présentation (`views/`)
- Localisation et fuseau horaire (`setlocale`, `date_default_timezone_set`)
