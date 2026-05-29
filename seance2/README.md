# Séance 2 — Manipulation de fichiers et génération HTML dynamique

> Réalisé par **Aboubacrin Simpara**  
> Cours de Technologies Web — Université de Lille

## Objectif

Lecture de données structurées depuis des fichiers texte, génération de HTML dynamique via des fonctions PHP, et introduction aux interfaces et classes (POO).

## Structure du projet

```
seance2/
├── bibliotheque.php        # Page principale : affiche tous les livres
├── livreUnique.php         # Page secondaire : affiche un seul livre
├── debug.php               # Page de débogage
├── exempleLivre.html       # Exemple statique HTML d'un livre
├── styles.css              # Feuille de style
├── couvertures/            # Images de couverture des livres
│   ├── dune.jpg
│   ├── fils-des-brumes.jpg
│   ├── miles-vorkosigan.jpg
│   ├── scorpion.jpg
│   ├── seigneur-des-anneaux.png
│   └── tony-chu.jpg
├── data/                   # Fichiers de données texte
│   ├── livres.txt              # Liste complète des livres
│   ├── exempleLivre.txt        # Exemple d'un livre valide
│   ├── exempleLivre2.txt       # Deuxième exemple
│   ├── exempleLivreErrone.txt  # Fichier avec données incorrectes (test)
│   └── .htaccess
├── lib/
│   ├── BookReader.class.php      # Interface BookReader
│   ├── FileBookReader.class.php  # Implémentation : lecture depuis un fichier
│   ├── fonctionsLivre.php        # Fonctions de génération HTML
│   └── .htaccess
└── views/
    ├── pageBibliotheque.php  # Vue : liste de tous les livres
    ├── pageLivreUnique.php   # Vue : un seul livre
    └── .htaccess
```

## Format des données (`data/livres.txt`)

Chaque livre est décrit par des paires `clé : valeur`, séparées par une ligne vide :

```
couverture : dune.jpg
titre : Dune
auteurs : Frank Herbert
annee : 1965
categorie : science-fiction
```

Attributs possibles : `couverture`, `titre`, `auteurs`, `annee`, `serie` (optionnel), `categorie`.

## Classes et interface

| Fichier | Rôle |
|---------|------|
| `BookReader` (interface) | Définit le contrat : `readBook() : ?array` — lit un livre et retourne un tableau associatif ou `NULL` |
| `FileBookReader` (classe) | Implémente `BookReader` — lit les livres ligne par ligne depuis un fichier texte |

## Fonctions de génération HTML (`fonctionsLivre.php`)

| Fonction | Description |
|----------|-------------|
| `elementBuilder(string $type, string $content, string $class)` | Génère une balise HTML avec classe optionnelle |
| `authorsToHTML(string $authors)` | Découpe les auteurs séparés par ` - ` et les entoure de `<span>` |
| `coverToHTML(string $fileName)` | Génère la balise `<img>` de la couverture dans une `<div>` |
| `propertyToHTML(string $propName, string $propValue)` | Convertit une propriété en HTML selon son type (titre → `<h2>`, annee → `<time>`, etc.) |
| `bookToHTML(array $book)` | Génère l'HTML complet d'un livre (`<article class="livre">`) |
| `libraryToHTML(BookReader $reader)` | Lit tous les livres via l'interface et génère la bibliothèque complète |

## Lancement

Déposer le dossier sur un serveur PHP et accéder à :

```
http://<serveur>/seance2/bibliotheque.php   # Tous les livres
http://<serveur>/seance2/livreUnique.php    # Premier livre du fichier
```

## Notions abordées

- Lecture de fichiers avec `fopen` / `fgets` / `fclose`
- Interfaces PHP (`interface`, `implements`)
- Classes PHP (POO) avec constructeur et destructeur
- Génération HTML dynamique depuis des données structurées
- Séparation des responsabilités : données (`data/`), logique (`lib/`), présentation (`views/`)
