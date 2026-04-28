<?php

function elementBuilder(string $elementType,string  $content,string $elementClass="") : string {
	if (empty($elementClass)) {
        return "<$elementType>$content</$elementType>";
    }else {
        return "<$elementType class='$elementClass'>$content</$elementType>";
    }
}


function authorsToHTML(string $authors): string {
    $authorArray = explode(' - ', $authors);
    return implode(' ', array_map(fn($author) => elementBuilder('span', $author), $authorArray));
}


function coverToHTML(string $fileName): string {
    return elementBuilder('div', '<img src="couvertures/' . htmlspecialchars($fileName) . '" alt="image de couverture" />', 'couverture');
}


function propertyToHTML(string $propName, string $propValue): string {
    switch ($propName) {
        case 'titre':
            return elementBuilder('h2', $propValue, $propName);
        case 'couverture':
            return elementBuilder('div', coverToHTML($propValue), $propName);
        case 'auteurs':
            return elementBuilder('div', authorsToHTML($propValue), $propName);
        case 'annee':
            return elementBuilder('time', $propValue, $propName);
        default:
            return elementBuilder('div', $propValue, $propName);
    }
}

function bookToHTML(array $book): string {
    // Commence par créer la couverture
    $coverHTML = coverToHTML($book['couverture'] ?? ''); // Utilisez une valeur par défaut si la couverture est manquante

    // Crée une chaîne pour les autres propriétés dans une div de classe "description"
    $descriptionHTML = '<div class="description">';
    $descriptionHTML .= propertyToHTML('titre', $book['titre'] ?? 'Titre inconnu');
    $descriptionHTML .= '<div class="auteurs">' . authorsToHTML($book['auteurs'] ?? '') . '</div>';
    $descriptionHTML .= propertyToHTML('année', $book['année'] ?? 'Année inconnue');
    
    if (isset($book['serie'])) {
        $descriptionHTML .= propertyToHTML('série', $book['serie']);
    }
    
    $descriptionHTML .= propertyToHTML('catégorie', $book['categorie'] ?? 'Catégorie inconnue');
    $descriptionHTML .= '</div>';
    
    // Retourne l'article complet
    return elementBuilder('article', $coverHTML . $descriptionHTML, 'livre');
}


// exercice 2

function libraryToHTML(BookReader $reader): string {
    $content = ''; // Chaîne pour stocker le contenu HTML

    // Lire chaque livre jusqu'à ce qu'il n'y en ait plus
    while ($book = $reader->readBook()) {
        $content .= bookToHTML($book); // Générer le HTML pour chaque livre et l'ajouter à la chaîne
    }

    // Vérifier si du contenu a été ajouté
    if (empty($content)) {
        return '<p>Aucun livre disponible.</p>'; // Message par défaut si aucun livre n'est trouvé
    }

    // Retourner le tout enveloppé dans une section
    return elementBuilder('section', $content);
}

?>
