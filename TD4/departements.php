<?php
    spl_autoload_register(function($classe){require "lib/$classe.class.php";}); // règle de chargement des classes
    
    $dsn_tw2 =  require('lib/dsn_tw2_def.php');

    require("lib/fonctions_html.php");
    require("lib/fonctions_parms.php");
 
    try {
        $dl = new DataLayer($dsn_tw2);

        $code_region = checkString('reg', NULL, FALSE);
        $departements = $dl->getDepartementsRegions($code_region);
        $table_departement = departementsToTable($departements);

        require("views/pageDepartements.php");
    } catch (ParmsException $e) {
        require "views/pageErreur.php";
    }
   
?>