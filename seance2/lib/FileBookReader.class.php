<?php
class FileBookReader implements BookReader {
    private $file;

    public function __construct(string $fileName) {
        $this->file = fopen($fileName, 'r');
        if (!$this->file) {
            throw new Exception("Impossible d'ouvrir le fichier : $fileName");
        }
    }
/*
    public function readBook(): ?array {
        $book = [];
        
        while (($line = fgets($this->file)) !== false) {
            $line = trim($line);
            
            if (empty($line)) {
                break; // Fin de la description du livre
            }
            
            $colonPos = strpos($line, ':');
            if ($colonPos === false) {
                throw new Exception("Format de ligne incorrect : $line");
            }
            
            $key = trim(substr($line, 0, $colonPos));
            $value = trim(substr($line, $colonPos + 1));
            
            // Convertir 'annee' en 'année'
            if ($key === 'annee') {
                $key = 'année';
            }
            
            $book[$key] = $value;
        }
        
        if (empty($book)) {
            return null; // Aucun livre trouvé ou fin du fichier atteinte
        }
        
        return $book;
    } */

	public function readBook(): ?array {
		$book = [];
		
		while (($line = fgets($this->file)) !== false) {
			$line = trim($line);
			
			// Ignorer les lignes vides
			if (empty($line)) {
				// Si le livre est déjà rempli, on retourne le livre
				if (!empty($book)) {
					return $book; // Retourne le livre complet dès qu'on a une ligne vide
				}
				continue; // Passer les lignes vides
			}
	
			// Vérifier le format de la ligne
			$colonPos = strpos($line, ':');
			if ($colonPos === false || $colonPos === 0 || $colonPos === strlen($line) - 1) {
				throw new Exception("Format de ligne incorrect : '$line'");
			}
			
			// Séparer la clé et la valeur
			$key = trim(substr($line, 0, $colonPos));
			$value = trim(substr($line, $colonPos + 1));
			
			// Convertir 'annee' en 'année'
			if ($key === 'annee') {
				$key = 'année';
			}
			
			// Ajouter la propriété au tableau
			$book[$key] = $value;
		}
	
		// Vérifier si le tableau est vide après lecture
		if (empty($book)) {
			return null; // Aucun livre trouvé ou fin du fichier atteinte
		}
	
		return !empty($book) ? $book : null; // Retourne le livre ou null si aucun livre n'est trouvé
	}

    public function __destruct() {
        if ($this->file) {
            fclose($this->file);
        }
    }
}

?>