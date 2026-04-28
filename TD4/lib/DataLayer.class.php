<?php
/**
 * Classe dédiée à l'interrogation de la base de données
 *
 */
class DataLayer {
	// private ?PDO $conn = NULL; // le typage des attributs est valide uniquement pour PHP>=7.4

	private  $conn = NULL; // connexion de type PDO   compat PHP<=7.3

	/**
	 * @param $DSNFileName : file containing DSN
	 */
	function __construct(string $dsn){
		$this->conn = new PDO($dsn);
		// paramètres de fonctionnement de PDO :
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // déclenchement d'exception en cas d'erreur
		$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); // fetch renvoie une table associative
		// réglage d'un schéma par défaut :
		// $this->conn->query('set search_path= ....');
	}

	/**
	 * Renvoie la liste des régions,
	 *   chacune avec les attributs reg (code région) et libelle (nom)
	 * @return (string[])[]  liste de régions
	 */
	function getRegions() : array {
		$sql = <<<EOD
			select reg, libelle
			 from tw2.cog.regions
EOD;
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}



	/* d'autres méthodes seront à créer ici pour l'exercice 1 */
	function getDepartementsRegions(?string $reg = NULL) : array {
		$sql = <<<EOD
		SELECT dep, regions.libelle as region_libelle, departements.libelle as libelle_reg
		FROM tw2.cog.departements
		INNER JOIN tw2.cog.regions ON departements.reg = regions.reg
		WHERE regions.reg LIKE :reg
		EOD;
	
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':reg', $reg ?? '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}

?>
