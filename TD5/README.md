# TD5 — Authentification et gestion des utilisateurs

> Réalisé par **Aboubacrin Simpara**  
> Cours de Technologies Web — Université de Lille

## C'est quoi ce TD ?

Dans ce TD, on a mis en place un système d'authentification complet : inscription, connexion, session et déconnexion. Les mots de passe sont hashés en base de données, et on utilise les sessions PHP pour garder l'utilisateur connecté d'une page à l'autre.

## Comment ça marche ?

### Se connecter
On arrive sur `index.php`. Si on n'est pas encore connecté, on voit le formulaire de login. On entre son login et mot de passe, PHP vérifie en base de données, et si c'est bon on arrive sur la page d'accueil. La session garde en mémoire qu'on est connecté, donc si on revient sur `index.php` sans se déconnecter, on est directement redirigé vers l'accueil.

### Créer un compte
On va sur la page d'inscription (`pageRegister.php`), on remplit nom, prénom, login et mot de passe. Le mot de passe est hashé avec `password_hash()` avant d'être stocké en base. Si le login existe déjà, un message d'erreur s'affiche.

### Se déconnecter
`logout.php` détruit la session et affiche un message de confirmation avec un lien pour revenir.

## Organisation des fichiers

```
TD5/
├── index.php          # Page principale : vérifie la session et affiche l'accueil ou le login
├── create_user.php    # Traite le formulaire d'inscription
├── logout.php         # Détruit la session et déconnecte l'utilisateur
├── test_auth.php      # Page de test d'authentification (sans session)
├── phpinfo.php        # Infos PHP (debug)
├── style_authent.css  # Feuille de style
├── images/
│   └── avatar_def.png # Avatar par défaut
├── lib/
│   ├── authent_lib.php          # Fonctions d'authentification (check_login_post, check_login_with_session)
│   ├── DataLayer.class.php      # Requêtes SQL : authentification + création d'utilisateur
│   ├── Identite.class.php       # Classe représentant un utilisateur connecté
│   ├── fonctions_parms.php      # Validation des paramètres POST
│   ├── dsn_perso_def.php        # Connexion à la base de données (non versionné)
│   └── ParmsException.class.php
└── views/
    ├── pageAccueil.php   # Page affichée après connexion réussie
    ├── pageLogin.php     # Formulaire de connexion
    ├── pageRegister.php  # Formulaire d'inscription
    ├── pageCreateOK.php  # Confirmation de création de compte
    ├── pageLogout.php    # Page de déconnexion
    ├── pageSimple.php    # Page simple (test)
    └── pageErreur.php    # Page d'erreur
```

## La gestion de l'authentification (`authent_lib.php`)

Il y a deux fonctions principales :

**`check_login_post()`** — Version simple sans session. Elle lit `$_POST['login']` et `$_POST['password']`, appelle la fonction d'authentification de la base, et renvoie l'identité si c'est bon, sinon lève une `AuthentException`.

**`check_login_with_session()`** — Version avec session. Elle démarre la session, vérifie d'abord si l'utilisateur est déjà connecté (via `$_SESSION['ident']`), et si oui retourne directement son identité sans retourner à la base. Sinon, elle appelle `check_login_post()` et stocke le résultat en session.

## La base de données (`DataLayer.class.php`)

Deux méthodes :

- **`authentification(login, password)`** — cherche l'utilisateur par login, puis vérifie le mot de passe avec `password_verify()`. Retourne un objet `Identite` si ok, `null` sinon.
- **`createUser(login, password, nom, prenom)`** — insère un nouvel utilisateur en hashant le mot de passe avec `password_hash()` avant l'insertion.

## La classe Identite

Un simple objet avec trois champs : `login`, `nom`, `prenom`. C'est ce qui est stocké dans `$_SESSION['ident']` quand l'utilisateur est connecté.

## Ce qu'on a appris

- Gérer des sessions PHP (`session_start`, `$_SESSION`, `session_destroy`)
- Hasher et vérifier des mots de passe avec `password_hash` / `password_verify`
- Séparer la logique d'authentification dans une librairie réutilisable
- Gérer les exceptions pour les erreurs d'authentification
- Construire un flux complet : inscription → connexion → accueil → déconnexion
