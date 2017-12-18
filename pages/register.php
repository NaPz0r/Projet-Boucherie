<?php
        require_once "include/config.php";        
        $message = "";

        if(!empty($_POST)){
            
            require("include/function_crud.php");
            require("include/function_form.php");
            $dataToVerif = Array("firstname","lastname","phonenumber","email","password");
            
            if(!verifParams($_POST, $dataToVerif)):
                $message .= "<p> Erreur d'envoi d'informations</p>";
                
            elseif(!verifEmail($_POST["email"])):
                $message .= "<p> Votre adresse mail est incorrecte</p>";
                
            else:
                $retour = true;
                if(strlen($_POST["firstname"]) > 70){

                    $message .= "<p>Votre prénom doit être compris entre 2 et 70 caractères </p>";
                    $retour = false;

                }
                if(strlen($_POST["lastname"]) > 70){

                    $message .= "<p>Votre nom doit être compris entre 2 et 70 caractères </p>";
                    $retour = false;

                }
                $_POST["phonenumber"] = str_replace(".","",$_POST["phonenumber"]);
                $_POST["phonenumber"] = str_replace(" ","",$_POST["phonenumber"]);
                $_POST["phonenumber"] = str_replace(",","",$_POST["phonenumber"]);
                $_POST["phonenumber"] = str_replace("-","",$_POST["phonenumber"]);

                if(strlen($_POST["phonenumber"]) > 10){
                    $message .= "<p>Votre numéro de téléphone doit faire 10 chiffres. </p>";
                    $retour = false;
                }
                if(emailExist($_POST["email"])){
                    $message ="<p> Email déjà utilisé, <a href='login.php'>Connectez vous</a> </p>";
                    $retour = false;
                }

                if($retour == true){
                    $test = registerClient($_POST);
                    var_dump($test);
                    header('Location: index.html');
                    exit;
                }
            endif;
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php require("page_include/head.php");?>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <!-- rajout d'une méthode -->
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="firstname" name="firstname" type="firstname" value="<?= (isset($_POST["firstname"])) ? $_POST["firstname"] : ""?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="lastname" name="lastname" type="lastname" value="<?= (isset($_POST["lastname"])) ? $_POST["lastname"] : ""?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="0322222222" name="phonenumber" type="phonenumber" value="<?= (isset($_POST["phonenumber"])) ? $_POST["phonenumber"] : ""?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?= (isset($_POST["email"])) ? $_POST["email"] : ""?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- Remplacement du lien a par button -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                                <a class="btn btn-lg btn-block btn-primary" href="login.php" role="button">Login</a>
                                <?= $message ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>