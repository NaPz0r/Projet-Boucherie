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
                                    <input id="mailform" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input id="passform" class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- Remplacement du lien a par button -->
                                <button type="submit" id="envoiform" class="btn btn-lg btn-success btn-block">Login</button>
                                <a class="btn btn-lg btn-block btn-primary" href="register.php" role="button">Register</a>
                                <div id="message"></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require("page_include/footer.php");?> 

<script>

// function validateEmail(email){
// 	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
// 	var valid = emailReg.test(email);

// 	if(!valid) {
//         return false;
//     } else {
//     	return true;
//     }
// }


// $("#envoiform").click(function(e){
//     e.preventDefault();
//     test = true;
//     var expression = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

//     if(validateEmail("#mailform").val()){      
//         console.log("Mail correct");
//     } else{
//         alert("Email is not correct format return false.");
//         $("#mailform").css("border-color","red");
//     }

//     if($("#passform").val() < 5){
//         test = false;
//         $("#passform").css("border-color","red");
//         console.log("Pass trop court");
//     }
// })

$("form").submit(function(e){

    e.preventDefault();
    let error = false;

    if($("#mailform").val().trim() == ""){
        $("#message").append("<p>Veuillez remplir votre email</p>");
        error = true;
    }
    if($("#passform").val().trim() == ""){
        $("#message").append("<p>Veuillez remplir votre pass</p>");
        error = true;
    }
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if(!expr.test($("#mailform").val().trim().toLowerCase())){
        $("#message").append("<p>Veuillez remplir votre email</p>");
        error = true;   
    }

    if(!error){
        var request = $.ajax({
        url: "http://localhost/webforce3/PHP/Projet/pages/include/api.php",
        method: "POST",
        data: $("form").serialize(),
        dataType: "json"
        });

        request.done(function( user ) {
            if(user.error)
                console.warn(user.message)
            else
                console.info(user)
        });

        request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        });
    }
})

</script>
</body>
</html>