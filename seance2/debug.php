<?php
/**
 * Indique au navigateur qu'il doit afficher du texte ordinaire, sans l'interpréter comme de l'HTML :
*/
header("Content-Type: text/plain;charset=UTF-8");

/**
 * Inclusion du fichier de définitions de fonctions :
 */
require("lib/BookReader.class.php");
require("lib/FileBookReader.class.php");
require_once("lib/fonctionsLivre.php");    // inclusion de fichier

/* Test question 1.1
 */

/* fonction de test
 *  reçoit comme argument un nom de fichier et affiche le résultat de readBook sur ce fichier
 */
function testReadBook($fileName){
    $dl = new FileBookReader($fileName);
    $book = $dl->readBook();
    echo "Résultat pour $fileName \n";
    print_r($book);
}

/*
 * Lancement des tests :
 */
// une description corretce de livre suivie de la fin de fichier
// doit produire un résultat correct
testReadBook('data/exempleLivre.txt');

// une description de livre,(avec des espaces inutiles) suivie d'une ligne vide puis d'un autre texte à ignorer
// doit produire un résultat correct
testReadBook('data/exempleLivre2.txt');

// une description de livre incorrecte (manque ':' en ligne 2)
// doit déclencher une exception
testReadBook('data/exempleLivreErrone.txt');

/**
 * Test question 1.2
 */

/**
 * Test de la fonction elementBuilder
 */
function testElementBuilder() {
    echo "Test de elementBuilder :\n";
    echo elementBuilder('p', 'bla bla') . "\n";
    echo elementBuilder('h2', 'La marque du diable', 'titre') . "\n";
}

// Appelez explicitement la fonction de test
testElementBuilder();

/**
 * Fonction de test unitaire pour authorsToHTML()
 */
function testAuthorsToHTML() {
    echo "Test de authorsToHTML :\n";
    
    $testCases = [
        'Frank Herbert',
        'Marini - Desberg',
        'John Layman - Rob Guillory'
    ];

    foreach ($testCases as $authors) {
        echo "Entrée : " . $authors . "\n";
        echo "Résultat : ";
        print_r(authorsToHTML($authors));
        echo "\n\n";
    }
}

// Appel de la fonction de test
testAuthorsToHTML();

/**
 * Fonction de test unitaire pour coverToHTML()
 */
function testCoverToHTML() {
    echo "Test de coverToHTML :\n";
    
    $fileName = 'scorpion.jpg';
    
    echo "Entrée : " . $fileName . "\n";
    echo "Résultat : ";
    print_r(coverToHTML($fileName));
    echo "\n";
}

// Appel de la fonction de test
testCoverToHTML();

/**
 * Fonction de test unitaire pour propertyToHTML()
 */
function testPropertyToHTML() {
    echo "Test de propertyToHTML :\n\n";
    
    $testCases = [
        ['titre', 'La marque du diable'],
        ['couverture', 'scorpion.jpg'],
        ['auteurs', 'Marini - Desberg'],
        ['annee', '2000'],
        ['categorie', 'bandes-dessinées']
    ];

    foreach ($testCases as $case) {
        echo "Entrée : propName = '{$case[0]}', propValue = '{$case[1]}'\n";
        echo "Résultat : ";
        print_r(propertyToHTML($case[0], $case[1]));
        echo "\n\n";
    }
}

// Appel de la fonction de test
testPropertyToHTML();

/**
 * Fonction de test unitaire pour bookToHTML()
 */
function testBookToHTML() {
    echo "Test de bookToHTML :\n";

    // Exemple de livre basé sur le contenu du fichier livres.txt
    $exampleBook = [
        'couverture' => 'scorpion.jpg',
        'titre' => 'La marque du diable',
        'serie' => 'Le Scorpion',
        'auteurs' => 'Marini - Desberg',
        'annee' => '2000',
        'categorie' => 'bandes-dessinées'
    ];

    echo "Résultat : ";
    print_r(bookToHTML($exampleBook));
}

// Appel de la fonction de test
testBookToHTML();

/**
Voilà ce qui devrait s'afficher :
=================================

Résultat pour data/exempleLivre.txt 
Array
(
    [couverture] => scorpion.jpg
    [titre] => La marque du diable
    [serie] => Le Scorpion
    [auteurs] => Marini - Desberg
    [année] => 2000
    [catégorie] => bandes-dessinées
)
Résultat pour data/exempleLivre2.txt 
Array
(
    [couverture] => scorpion.jpg
    [titre] => La marque du diable
    [serie] => Le Scorpion
    [auteurs] => Marini - Desberg
    [année] => 2000
    [catégorie] => bandes-dessinées
)
<br />
<b>Fatal error</b>:  Uncaught Exception: .....etc ....
 

*/

?>