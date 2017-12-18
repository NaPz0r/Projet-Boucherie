<?php

verifParams($_POST, Array("email", "password"));

// Test unitaire de verification de mail
// $toto = verifEmail("azfafzaf@afazf.czfzefzfom");
// var_dump($toto);

/*
    Fonction qui vérifie la syntaxe de l'adresse email saisie
*/


function verifEmail($email){
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
}

/*
    Function qui vérifie les paramètres saisis dans un formulaire
*/
function verifParams($data, $array){

    $retour = true;


    if (count($data) != count($array)) // Vérification du nombre d'éléments dans les 2 tableaux de données
        return false;

    foreach($array as $valeur){ // On parcourt les éléments obligatoire
        
        $retour = false;

        foreach($data as $key => $valData){ // On parcourt les données envoyées par le formulaire ($_POST)
        
            $retour = ($valeur == $key && !empty(trim($valData))) ? true : $retour;
        }

        if($retour != true) // Si la valeur change suite à la condition dans le second foreach, il retourne false.
            return false;
    }

    return $retour;
    
}







?>