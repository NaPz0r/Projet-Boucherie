<?php

    require_once "function_crud.php";
    
    if (!empty($_POST)){
        if (isset($_POST["email"]) && isset($_POST["password"])){

            $retour = array("error" => true);

            $user = connectUser(trim($_POST["email"]), trim($_POST["password"]));

            if($user == -1){
                $array["message"] = "Utilisateur inconnu";
            }elseif($user == -2){
                $array["message"] = "Email ou password incorrects";
            }else{
                $array["error"] = false;
                $array["user"] = $user;
            }
            echo json.encode($retour);
        }
        else
            echo "Ma bite est noire et grosse !!!!!!";
    }
    else
        echo "Ma bite!!!!!!";
?>