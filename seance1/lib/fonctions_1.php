<?php
    //  créer les fonctions ici 

    function afficheVar(int $n, string $s) : string {   
       return "l'entier vaut $n" . " et la chaine vaut:  $s";
    }

    function n_parag(string $texte, int $nb) : string {
       $res = "";
       for($i = 0; $i < $nb; $i++){
         $res .= "<p>$texte</p>"; 
       }
       return $res;
    }
   
    function paragrapheTronque(string $s,int $i): string {
        return "<p>".substr($s,0,$i)."</p>";
    } 
   
    function diminue(string $chaine): string {
      $resultat = "";
      $longueur = strlen($chaine);
      
      for ($i = $longueur; $i >= 0; $i--) {
          $paragraphe = substr($chaine, 0, $i);
          $resultat .= "<p>" . $paragraphe . "</p>\n";
      }
      
      return $resultat;
    }

    function multiplication(int $n1, int $n2) : string {
      $res = "";
      $res = "<ul><li> $n1 * $n2 = ". $n1 * $n2 . "</li></ul>";
      return $res;
    }

    function tableMultiplication(int $n1, int $n2) : string {
      $res = "<ul>";
      for ($l = 1; $l <= $n2; $l++) {
          $res .= "<li>$n1 * $l = " . ($n1 * $l) . "</li>";
      }
      $res .= "</ul>";
  
      return $res;
  }

    function tablesMultiplications() : string {
      $res = "<ul>";
      for ($k = 1; $k <= 9; $k++) {
          $res .= "<li><ul>";
          for ($j = 1; $j <= 9; $j++){
              $res .= "<li>$k * $j = " . ($k * $j) . "</li>";
          }
          $res .= "</ul></li>";
      }
      $res .= "</ul>";
      
      return $res;
    }

    function ligneEntete() : string {
      $res = "<tr><th></th>";
      for ($i = 1; $i <= 9; $i++) {
          $res .= "<th>$i</th>";
      }
      $res .= "</tr>";
      return $res;
  }
  
  function ligneTable(int $i) : string {
      $res = "<tr><th>$i</th>";
      for ($j = 1; $j <= 9; $j++) {
          $res .= "<td>" . ($i * $j) . "</td>";
      }
      $res .= "</tr>";
      return $res;
  }
  
  function tableauMult() : string {
      $res = "<table id='multiplications'>";
      $res .= ligneEntete();
      for ($i = 1; $i <= 9; $i++) {
          $res .= ligneTable($i);
      }
      $res .= "</table>";
      return $res;
  }

  function formatString($input) : string {
    // Découper la chaine en parties en utilisant '+' comme séparateur
    $chaine = explode('+', $input);
     
    //Supprimer les espaces au débuts et à la fin de chaque partie
    $chaine = array_map('trim', $chaine);

    // Entourer chaque partie avec des balises <p>
    $formateChaine = array_map(function($chaine){
        return "<p>". $chaine . "</p>";
    }, $chaine);
     
    //Joindre les parties formatées en une seule chaine
    return implode('', $formateChaine);
  }

  function enSpan($s) : string {
    // Utiliser ' - ' comme séparateur (notez les espaces avant et après le tiret)
    $parties = explode(' - ', $s);
    
    // Supprimer les espaces au début et à la fin de chaque partie
    $parties = array_map('trim', $parties);
    
    // Entourer chaque partie avec des balises <span>
    $partiesFormatees = array_map(function($partie) {
        return "<span>" . $partie . "</span>";
    }, $parties);
    
    // Joindre les parties formatées en une seule chaîne
    return implode('', $partiesFormatees);
}

?>