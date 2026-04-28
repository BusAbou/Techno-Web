<?php
 require(__DIR__."/color_defs.php"); // definit la constante COLOR_KEYWORDS

 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter une couleur CSS
  *  @return : valeur retenue
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
  function checkColor(string $name, string $defaultValue) : string {

  if ($name === 'bg' && isset($_GET['bgTransparent']) && $_GET['bgTransparent'] === 'on') {
      return 'transparent';
  }
  
   if (!isset($_GET[$name]) || $_GET[$name] === '') {
       return $defaultValue;
   }
   
   $color = $_GET[$name];
   if ($color === 'transparent' || isset(COLOR_KEYWORDS[$color]) || preg_match(COLOR_REGEXP, $color)) {
       return $color;
   }
   
   throw new ParmsException("La couleur que vous avez saisie est incorrecte");
}
  
 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkUnsignedInt(string $name, int $defaultValue) : int {
    if (!isset($_GET[$name]) || $_GET[$name] === '') {
      return $defaultValue;
    }   

    if (!ctype_digit($_GET[$name])){
      throw new ParmsException("Le paramètre '$name' doit être un entier sans signe.");
    }

    return (int)$_GET[$name];
  }
     
 ?>