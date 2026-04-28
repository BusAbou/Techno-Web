<h1>Terrain de Jeu</h1>
<?php
   $terrain = lireTerrain('terrain1.txt');
   if ($terrain === false) {
       echo "<p>Erreur : Les données du terrain sont incorrectes.</p>";
   } else {
       echo genererTableHTML($terrain);
   }
?>