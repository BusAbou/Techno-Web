<?php
function lireTerrain($nomFichier) {
    $terrain = [];
    $file = fopen($nomFichier, 'r');
    $ligne = fgets($file);
    $longueurLigne = strlen(trim($ligne));
    
    while ($ligne !== FALSE) {
        $ligneTrim = trim($ligne);
        if ($ligneTrim !== '') {
            if (strlen($ligneTrim) !== $longueurLigne) {
                fclose($file);
                return false; // Erreur : lignes de longueurs différentes
            }
            $terrain[] = $ligneTrim;
        }
        $ligne = fgets($file);
    }
    fclose($file);
    
    if (count($terrain) !== $longueurLigne) {
        return false; // Erreur : terrain non carré
    }
    
    return $terrain;
}

function genererTableHTML($terrain) {
    $html = '<table>';
    foreach ($terrain as $ligne) {
        $html .= '<tr>';
        for ($i = 0; $i < strlen($ligne); $i++) {
            $case = $ligne[$i];
            $classe = '';
            $contenu = '';
            switch ($case) {
                case 'B':
                    $classe = 'blanc';
                    $contenu = '<span>B</span>';
                    break;
                case 'N':
                    $classe = 'noir';
                    $contenu = '<span>N</span>';
                    break;
            }
            $html .= "<td class='$classe'>$contenu</td>";
        }
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;
}
?>