<?php

@include "database.php";

if(isset($_POST["submit"])){
    $name = mysqli_real_escape_string($database, $_POST["name"]);
    $nif = mysqli_real_escape_string($database, $_POST["nif"]);
    $username = mysqli_real_escape_string($database, $_POST["username"]);
    $password = mysqli_real_escape_string($database, $_POST["password"]);

    $insert = "INSERT INTO user(name, nif, username, password) VALUES('$name', '$nif', '$username', '$password')";
    mysqli_query($database, $insert);
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrustBank</title>
    <script src="https://kit.fontawesome.com/486da4ca0e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        <div class="signup">
            <form id="signupForm" action="#" method="POST">
                <h2>Criar Conta</h2>
                <div class="inputbox">
                    <input name="name" type="name" id="name" placeholder="Nome completo" onkeyup="validateName()">
                </div>
                <div class="error" id="nameError"></div>
                <div class="inputbox">
                    <input name="nif" type="number" id="nif" placeholder="Nº identificação fiscal" onkeyup="validateNif()">
                </div>
                <div class="error" id="nifError"></div>
                <div class="inputbox">
                    <input name="username" type="name" id="username" placeholder="Nome de utilizador" onkeyup="validateUsername()">
                </div>
                <div class="error" id="usernameError"></div>
                <div class="inputbox">
                    <input name="password" type="password" id="password" placeholder="Palavra-Passe" onkeyup="validatePassword()">
                </div>
                <div class="error" id="passwordError"></div>

                <div class="registerbutton">
                    <input name="submit" type="submit" id="signupButton" value="Registar">
                </div> 

                <div class="login">
                    <p>Já tem conta? <a href="../templates/login.php">Inicie sessão.</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
