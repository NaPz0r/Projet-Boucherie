<?php

// require "config.php";


$message = false;
$bdd = connectToDatabase();

/*
    Test unitaire
*/
// $remi = connectToDatabase();
// var_dump($remi);
// cryptPassword("Mike");




function connectToDatabase(){ 
    
    try {
        
        $bdd = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_DB, DATABASE_USER, DATABASE_PASS); // Création d'une instance de connexion à la base de données (http://php.net/manual/fr/pdo.connections.php)
        return $bdd; 
    } catch (PDOException $e) {
        
        $GLOBALS["message"] = print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function emailExist($email){
    
    $sql = "SELECT COUNT(*) AS Nb FROM `clients` WHERE `email` = ?"; // Requête qui renvoie le nombre de clients dont l'email est égal à $email.
    
    $request = $GLOBALS["bdd"]->prepare($sql); // Préparation de la requête avant execution
    
    $request->execute(Array($email)); // Execute la requête en remplaçant les ? par les datas du tableau
    
    $array = $request->fetchAll(PDO::FETCH_ASSOC); //Trie des données
    
    return (bool)$array[0]["Nb"]; // Cast le tableau en booléen (retourne oui ou non)

}

function registerClient($client){
    // var_dump( $GLOBALS["bdd"]);
    $sql = "INSERT INTO `clients`( `firstname`, `lastname`, `email`, `encrypte`, `phone`, ) VALUES (:firstname, :lastname, :email, :encrypte, :phone )";

    $request = $GLOBALS["bdd"]->prepare($sql);

    $array = Array(         // On peut mettre les champs dans le désordre
        ":lastname" => $client["lastname"], 
        ":email" => $client["email"], 
        ":firstname" => $client["firstname"],
        ":phone" => $client["phonenumber"],
        ":encrypte" => crytPassword($client["password"])
    );

    $request->execute($array);

    return $GLOBALS["bdd"]->lastInsertId();
}

function cryptPassword($password){
    
    $crypt = sha1(rand(11,22)."Mike".uniqid()."Mike".rand(11,22));
    $newpassword = crypt($password, $crypt);
    return crypt($password, $crypt);

}
// Possibilité de rajouter un catcha au bout de X tentatives ou bannir une IP si trop d'essais.
function comparePassword($hash_password, $password){

    return (hash_equals($hashed_password, crypt($password, $hashed_password))) ? true : false;

}



?>