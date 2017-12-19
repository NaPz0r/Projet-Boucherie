<?php
    header("Acces-Control-Allow-Origin: *");
    require_once "function_crud.php";
    
    if (!empty($_POST)){
        if (isset($_POST["email"]) && isset($_POST["password"])){

            $retour = array("error" => true);

            $user = connectUser(trim($_POST["email"]), trim($_POST["password"]));

            if($user == -1){
                $retour["message"] = "Utilisateur inconnu";

            }elseif($user == -2){
                $retour["message"] = "Email ou password incorrects";
                
            }else{
                $retour["error"] = false;
                $retour["user"] = $user;
            }
            echo json_encode($retour);
        }
        else
            echo "test1";
    }
    else
        echo "test2";

        // Pour debug, aller voir dans Network -> api.php
?>