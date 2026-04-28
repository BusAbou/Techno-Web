<?php
class DataLayer {
	// private ?PDO $connexion = NULL; // le typage des attributs est valide uniquement pour PHP>=7.4

	private  $connexion = NULL; // connexion de type PDO   compat PHP<=7.3

	/**
	 * @param $DSNFileName : file containing DSN
	 */
	function __construct(string $dsn, ?array $options = null){
		$this->connexion = new PDO($dsn, options:$options);
		// paramètres de fonctionnement de PDO :
		$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // déclenchement d'exception en cas d'erreur
		$this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); // fetch renvoie une table associative
		// réglage d'un schéma par défaut :
		$this->connexion->query('set search_path=authent');
	}

    function authentification(string $login, string $password) : ?Identite{ // version password hash
        $sql = <<<EOD
              SELECT * FROM authent.users WHERE login = :login
        EOD;
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([':login' => $login]);
        $resultat = $stmt -> fetch();
        /*
        var_dump($resultat); // Affiche le résultat de la requête
        if ($resultat) {
            var_dump(password_verify($password, $resultat['password'])); // Vérifie si le mot de passe correspond
        }
        */
        if ($resultat && password_verify($password, $resultat['password'])) {
            return new Identite($resultat['login'], $resultat['nom'], $resultat['prenom']);
        }

        return null;
    }

    /**
    * @return bool indiquant si l'ajout a été réalisé
    */
    function createUser(string $login, string $password, string $nom, string $prenom) : bool	 {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = <<<EOD
           INSERT INTO authent.users (login, password, nom, prenom) 
           VALUES (:login, :password, :nom, :prenom)
        EOD;
        $stmt = $this->connexion->prepare($sql);

        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);


        try {
            $stmt->execute(); // pour un CREATE
            return $stmt->rowCount() == 1; // vérification modif effectuée
        } catch (PDOException $e) {
          return false;
        }

    }


}
?>
