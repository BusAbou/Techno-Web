<?php

/**
 * construit une ligne de table HTML représentant une région
 * @param string[] $r tableau associatif contenant au moins les clés reg et libelle
 */
function regionToRow(array $r):string{
    return "<tr><td>{$r["reg"]}</td><td>{$r["libelle"]}</td></tr>";
}

/**
 * construit une table HTML représentatnt une liste de régions
 * @param (string[])[] $regions liste de tableaux associatifs représentant une région
 */
function regionsToTable(array $regions):string{
 $rows = implode(array_map('regionToRow',$regions));
 return "<table><tbody>$rows</tbody></table>";
}
/* d'autres fonctions seront à créer ici pour l'exercice 1 */

/**
 * construit une ligne de table HTML représentant une région
 * @param string[] $s tableau associatif contenant au moins les clés reg et libelle
 */
function departementToRow(array $s): string {
    return "
        <tr>
           <td>{$s["dep"]}</td>
           <td>{$s["region_libelle"]}</td>
           <td>{$s["libelle_reg"]}</td>
        </tr>";
}

/**
 * construit une table HTML représentatnt une liste de régions
 * @param (string[])[] $departement liste de tableaux associatifs représentant une région
 */
function departementsToTable(array $departements): string {
    $header = "
        <tr>
           <th>Code_dep</th>
           <th>Région</th>
           <th>Département</th>
        </tr>";
    $rows = implode(array_map('departementToRow', $departements));
    return "<table><thead>$header</thead><tbody>$rows</tbody></table>";
}

/**
 * qui produit, à partir d’une liste de régions, une liste d’éléments 
 * <option> ayant pour attribut value un code de région et pour texte affiché le nom de la
 *  région (exemple d’option :<option value="32">Hauts de France</option>)
 * @param (string[])[] $regions liste de tableaux associatifs représentant une région
 */
function regionsToOptions(array $regions) : string{
    $options = array_map(function($r){
        return "<option value='{$r["reg"]}'>{$r["libelle"]}</option>";
    },$regions);
   return implode($options);
}


?>
