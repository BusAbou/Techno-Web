# TD4 — Régions et Départements de France

> Réalisé par **Aboubacrin Simpara**  
> Cours de Technologies Web — Université de Lille

## C'est quoi ce TD ?

Dans ce TD, on s'est connecté pour la première fois à une vraie base de données PostgreSQL pour afficher les régions et départements de France. On a appris à faire des requêtes SQL depuis PHP avec PDO, et à construire des pages dynamiques à partir des données récupérées.

Il y a plusieurs pages dans ce TD, chacune correspond à un exercice différent.

## Les pages disponibles

**`regions.php`** — Affiche toutes les régions de France dans un tableau HTML. C'est la page la plus simple, elle fait juste un `SELECT` sur la table des régions.

**`departements.php`** — Affiche les départements, avec un filtre possible par région. On passe le code région en paramètre GET (`?reg=32` par exemple) et ça filtre les résultats.

**`dep_par_region.php`** — Une page avec un formulaire déroulant (`<select>`) qui liste les régions. L'utilisateur choisit une région et voit les départements correspondants.

**`regdep.php`** — Une autre variante du formulaire avec des fonctionnalités supplémentaires.

## Organisation des fichiers

```
TD4/
├── regions.php          # Liste toutes les régions
├── departements.php     # Liste les départements (filtrables par région)
├── dep_par_region.php   # Formulaire de recherche de départements par région
├── regdep.php           # Variante du formulaire
├── lib/
│   ├── DataLayer.class.php      # Toutes les requêtes SQL sont ici
│   ├── fonctions_html.php       # Fonctions qui transforment les données en HTML
│   ├── fonctions_parms.php      # Validation des paramètres GET
│   ├── fonctions_misc.php       # Fonctions utilitaires diverses
│   ├── dsn_tw2_def.php          # Fichier de connexion à la base de données
│   └── ParmsException.class.php # Exception pour les erreurs de paramètres
├── views/
│   ├── pageRegions.php      # Vue : tableau des régions
│   ├── pageDepartements.php # Vue : tableau des départements
│   ├── pageFormuRegion.php  # Vue : formulaire de sélection de région
│   ├── pageFormuDep.php     # Vue : formulaire départements
│   └── pageErreur.php       # Vue : page d'erreur
├── styles/
│   └── regions.css          # La feuille de style
└── images/
    └── Regions_de_France_2016.svg  # Carte SVG des régions
```

## La base de données

On travaille sur une base PostgreSQL avec le schéma `tw2.cog` qui contient les données du Code Officiel Géographique (COG) de France :

- `tw2.cog.regions` — les régions (code `reg` + `libelle`)
- `tw2.cog.departements` — les départements (code `dep`, code région `reg`, `libelle`)

La connexion est configurée dans `lib/dsn_tw2_def.php` (fichier non versionné pour des raisons de sécurité).

## La classe DataLayer

C'est le coeur du TD. Toutes les requêtes SQL passent par là, jamais directement dans les pages PHP. Elle a deux méthodes :

- `getRegions()` — récupère toutes les régions
- `getDepartementsRegions(?string $reg)` — récupère les départements, avec une jointure sur les régions. Si `$reg` est `NULL`, on récupère tout.

## Les fonctions HTML (`fonctions_html.php`)

Une fois les données récupérées, ces fonctions les transforment en HTML :

- `regionsToTable()` — transforme la liste des régions en `<table>`
- `departementsToTable()` — idem pour les départements, avec en-tête
- `regionsToOptions()` — transforme les régions en `<option>` pour un `<select>`

## Ce qu'on a appris

- Se connecter à une base de données PostgreSQL avec PDO en PHP
- Faire des requêtes préparées avec `bindValue` pour éviter les injections SQL
- Faire des jointures SQL entre deux tables
- Séparer les requêtes (DataLayer), la logique HTML (fonctions_html) et la présentation (views)
- Gérer un formulaire avec un `<select>` alimenté dynamiquement depuis la base
