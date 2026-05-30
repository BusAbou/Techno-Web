# TD6 — Carte interactive des communes de la MEL

> Réalisé par **Aboubacrin Simpara**  
> Cours de Technologies Web — Université de Lille

## C'est quoi ce TD ?

Dans ce TD, on a construit une application web interactive qui affiche les communes de la Métropole Européenne de Lille (MEL) sur une carte. L'utilisateur peut choisir un territoire dans un menu déroulant, voir la liste des communes correspondantes, et cliquer sur une commune pour afficher ses détails et zoomer sur ses limites géographiques.

C'est le TD le plus complet : il mêle PHP côté serveur, JavaScript côté client, des appels AJAX avec l'API Fetch, une carte interactive avec Leaflet, et une base de données PostgreSQL avec des données géographiques réelles.

## Comment ça marche ?

Quand la page se charge, JavaScript appelle automatiquement le service `getTerritoires.php` pour remplir le menu déroulant avec les territoires disponibles. Quand on sélectionne un territoire, la carte se recentre dessus. Quand on clique sur "Afficher la liste", un appel à `getCommunes.php` récupère les communes du territoire choisi et les affiche dans une liste. En survolant une commune, la carte se recentre dessus. En cliquant dessus, un appel à `getDetails.php` affiche les détails de la commune et trace ses contours sur une mini-carte.

## Organisation des fichiers

```
TD6/
├── index.php                    # Point d'entrée, charge la vue principale
├── demoTerritoires.php          # Page de démo des territoires
├── style_td6.css                # Feuille de style
├── js/
│   ├── fetchUtils.js            # Utilitaires Fetch (fetchFromJson, fetchText...)
│   ├── scriptPagePrincipale.js  # Logique principale de la page
│   ├── scriptDemoTerritoires.js # Script de la page démo
│   └── carte.js                 # Initialisation et gestion de la carte Leaflet
├── services/
│   ├── getTerritoires.php       # API : retourne la liste des territoires
│   ├── getCommunes.php          # API : retourne les communes d'un territoire
│   └── getDetails.php           # API : retourne les détails d'une commune (code INSEE)
├── lib/
│   ├── DataLayer.class.php      # Toutes les requêtes SQL
│   ├── common_service.php       # Fonctions communes aux services (produceResultAnswer...)
│   ├── fonctions_parms.php      # Validation des paramètres GET
│   ├── dsn_perso_def.php        # Connexion à la base (non versionné)
│   └── ParmsException.class.php
├── views/
│   ├── pagePrincipale.php       # Vue principale de l'application
│   ├── pageDemoTerritoires.php  # Vue de la démo
│   └── pageErreur.php
├── etc/
│   ├── users.txt                # Fichier utilisateurs (auth basique)
│   └── dsn_filename.php
└── py/
    ├── datalayer.py             # Équivalent Python de la DataLayer (script d'import)
    ├── db_config.py             # Config de la base en Python
    └── mel_communes.json        # Données brutes des communes en JSON
```

## Les services PHP (mini API REST)

Les trois scripts dans `services/` jouent le rôle d'une API. Ils renvoient toujours du JSON dans ce format :

```json
{ "status": "ok", "result": [ ... ] }
{ "status": "error", "message": "..." }
```

| Service | Paramètre | Ce qu'il retourne |
|---------|-----------|-------------------|
| `getTerritoires.php` | aucun | Liste des territoires avec leurs coordonnées géographiques |
| `getCommunes.php` | `territoire` (id, optionnel) | Liste des communes avec nom, code INSEE, lat/lon |
| `getDetails.php` | `insee` (obligatoire) | Détails d'une commune : surface, périmètre, population 2016, contours géo |

## La carte avec Leaflet

`carte.js` initialise une carte Leaflet centrée sur la MEL au chargement. Quand on clique sur une commune, `createDetailMap()` crée une deuxième mini-carte dans le panneau de détails et trace les contours géographiques de la commune à partir du champ `geo_shape` (un GeoJSON stocké en base).

## La base de données

On travaille avec le schéma `communes_mel` en PostgreSQL :

- `communes` — infos de base de chaque commune (insee, nom, lat, lon...)
- `territoires` — les territoires de la MEL
- `bb_communes` / `bb_territoires` — les bounding boxes (min/max lat/lon) pour le centrage de carte
- `population` — données de population par commune (recensement 2016)

## Ce qu'on a appris

- Créer une mini API en PHP qui retourne du JSON
- Utiliser l'API Fetch en JavaScript pour appeler des services côté serveur sans recharger la page
- Manipuler le DOM dynamiquement (listes, tableaux, détails)
- Intégrer Leaflet pour afficher une carte interactive
- Afficher des données géographiques (GeoJSON) sur une carte
- Construire une application web avec une vraie architecture client/serveur
