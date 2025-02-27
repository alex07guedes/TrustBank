<?php
@include "database.php";
session_start();
$error = "";

if(isset($_POST["submit"])){
    $adminname = mysqli_real_escape_string($database, $_POST["adminname"]);
    $password = mysqli_real_escape_string($database, $_POST["password"]);

    $select = "SELECT * FROM admin WHERE adminname = '$adminname' && password = '$password'";
    $result = mysqli_query($database, $select);

    if(mysqli_num_rows($result) == 1){
        $get_name = mysqli_fetch_assoc($result);
        $name = $get_name["adminname"];

        $_SESSION["name"] = $name;

        header("location: adminpage.php");
    }
    else{
        $error = "Nome de Utilizador / Palavra-Passe inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../static/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TrustBank</title>
        <script src="https://kit.fontawesome.com/795a734e49.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;500;700&display=swap" rel="stylesheet">
        <script defer src="../scripts/script.js"></script>
    </head>
    <body>
        <div class="img">
            <div class="navbar">
                <div class="logo">
                    <a href="../templates/index.html"><img src="../images/logo.png"> TrustBank</a>
                </div>
                <ul class="nav-listlogin">
                    <li><a href="../templates/index.html#">Home</a></li>
                    <li><a href="../templates/index.html#services">Serviços</a></li>
                    <li><a href="../templates/index.html#partnerships">Patrocinadores</a></li>
                    <li><a href="../templates/index.html#about-us">Sobre Nós</a></li>
                </ul>
            </div>
            <div class="login">
                <form action="#" method="POST">
                    <h2>Entrar como admin</h2>
                    <div class="inputbox">
                        <input type="name" name="adminname" id="username" placeholder="Nome de utilizador" onkeyup="validateUsername()">
                    </div>
                    <div class="error" id="usernameError"></div>
                    <div class="inputbox">
                        <input type="password" name="password" id="password" placeholder="Palavra-Passe" onkeyup="validatePassword()">
                    </div>    
                    <div class="error" id="passwordError"></div>
                    <div class="loginbutton">
                        <input name="submit" type="submit" id="signupButton" value="Iniciar Sessão">
                    </div> 
                    <h4 class="login-message"><?php echo $error; ?></h4>
                    <div class="register">
                        <p>Ainda não tem conta? <a href="../templates/signup.php">Crie uma!</a></p>
                        <p>Pretende iniciar como utilizador? <a href="../templates/login.php">Entre aqui!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
