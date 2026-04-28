<?php
   
   spl_autoload_register(function ($className) { // règle de chargement des fichiers de classe
    include ("lib/{$className}.class.php");
  });
   require 'lib/ParmsException.class.php' ; 
   /**
 * Vérifie si une chaîne de caractères est présente dans les paramètres POST.
 *
 * @param string $key La clé du paramètre à vérifier.
 * @param mixed $default La valeur par défaut à retourner si le paramètre n'est pas présent ou vide.
 * @param bool $trim Indique si la valeur doit être nettoyée (trim).
 * @return string|null La valeur du paramètre si elle est présente et non vide, sinon la valeur par défaut.
 */
function checkString(string $key, $default = null, bool $trim = false): ?string {
    // Vérifie si le paramètre existe dans $_POST
    if (isset($_POST[$key])) {
        $value = $_POST[$key];

        // Vérifie si c'est une chaîne et applique trim si nécessaire
        if (is_string($value)) {
            return $trim ? trim($value) : $value;
        }
    }

    // Lancer une exception si le paramètre n'est pas valide
    throw new ParmsException("valeur incorrecte pour le paramètre '$key'");
}
?>
