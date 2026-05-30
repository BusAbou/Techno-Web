# Terrain 1 — Grille de jeu interactive

> Réalisé par **Aboubacrin Simpara**  
> Cours de Technologies Web — Université de Lille

## C'est quoi ce projet ?

Un petit exercice qui combine PHP et JavaScript autour d'une grille de jeu. Le terrain est lu depuis un fichier texte, affiché sous forme de tableau HTML avec des cases colorées (blanc, noir, ou neutre), et l'utilisateur peut cliquer sur les cases pour changer leur état directement dans le navigateur.

## Comment ça marche ?

Le fichier `terrain1.txt` contient une grille carrée codée avec des lettres :

```
-B--N
B-NN-
-----
NN-BB
NBNBN
```

- `B` → case blanche
- `N` → case noire
- `-` → case neutre (grise)

PHP lit ce fichier, vérifie que la grille est bien carrée, et génère le tableau HTML avec les bonnes classes CSS. Une fois la page affichée, JavaScript prend le relais : un clic sur une case fait tourner son état dans l'ordre `neutre → blanc → noir → neutre`.

## Organisation des fichiers

```
terrain1/
├── iniPHP.php        # Point d'entrée : charge les fonctions et la vue
├── terrain1.txt      # Le fichier de données du terrain (grille 5×5)
├── iniPHP.css        # Styles des cases (blanc, noir, gris)
├── iniPHP.js         # Gestion des clics sur les cases
├── lib/
│   └── fonctions_1.php   # lireTerrain() + genererTableHTML()
└── views/
    └── page_1.php         # Vue : lit et affiche le terrain
```

## Les fonctions PHP (`fonctions_1.php`)

**`lireTerrain(string $nomFichier)`** — Lit le fichier ligne par ligne et retourne un tableau de chaînes. Vérifie que toutes les lignes ont la même longueur et que le terrain est carré (autant de lignes que de colonnes). Retourne `false` si le fichier est invalide.

**`genererTableHTML(array $terrain)`** — Parcourt le tableau et génère le `<table>` HTML. Chaque caractère devient un `<td>` avec la classe `blanc`, `noir`, ou rien (gris par défaut).

## L'interactivité JavaScript (`iniPHP.js`)

Au chargement de la page, un écouteur de clic est ajouté à chaque cellule du tableau. Le clic fait tourner l'état de la case :

```
neutre (gris) → blanc → noir → neutre (gris) → ...
```

## Ce qu'on a appris

- Lire et parser un fichier texte en PHP avec `fopen` / `fgets`
- Valider la structure d'un fichier avant de l'utiliser
- Générer du HTML dynamiquement depuis un tableau PHP
- Manipuler les classes CSS d'un élément avec JavaScript au clic
