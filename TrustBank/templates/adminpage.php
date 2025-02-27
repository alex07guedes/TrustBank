<?php
session_start();

@include "database.php";

if(isset($_POST["submit"])){

    $adminname = mysqli_real_escape_string($database, $_POST["adminname"]);
    $password = mysqli_real_escape_string($database, $_POST["password"]);
    $bankcode = mysqli_real_escape_string($database, $_POST["bankcode"]);
   

    $select = "SELECT * FROM admin WHERE adminname = '$adminname' && password = '$password'";
    $result = mysqli_query($database, $select);

    $insert = "INSERT INTO admin(adminname, password, bankcode) VALUES('$adminname', '$password', '$bankcode')";
    mysqli_query($database, $insert);
    header("location: adminlogin.php");

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../static/adminpage.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TrustBank</title>
        <script src="https://kit.fontawesome.com/486da4ca0e.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;500;700&display=swap" rel="stylesheet">
        <script defer src="../scripts/admin.js"></script>
    </head>
    <body class="img">
        <header>
            <div class="top">
               <div class="logo">
                   <img src="../images/logo.png">
               </div>
               <div class="logout">
                    <a href="login.php">Terminar Sessão</a>
                </div>
                <div class="title">
                    <a>TrustBank</a>
                </div>
            </div>
        </header>
        <main>
            <table class="useraccounts">
                <tr>
                    <th>ID</th>
                    <th>Nome completo</th>
                    <th>NIF</th>
                    <th>Nome de utilizador</th>
                    <th>Palavra-Passe</th>
                    <th>Saldo da conta</th>
                </tr>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "user_database");
                if ($conn->connect_error) {
                    die("Erro: " . $conn->connect_error);
                }

                $sql = "SELECT ID, Name, NIF, Username, Password, balance from user";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["NIF"] . "</td><td>" . $row["Username"] . "</td><td>" . $row["Password"] . "</td><td>" . $row["balance"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Sem conteúdo";
                }
                $conn->close();
                ?>
            </table>
            <table class="adminaccounts">
                <tr>
                    <th>ID</th>
                    <th>Nome de administrador</th>
                    <th>Palavra-Passe</th>
                    <th>Código bancário</th>
                </tr>
                <?php
                    $selectAdmins = "SELECT ID, AdminName, Password, Bankcode FROM admin";
                    $adminResult = mysqli_query($database, $selectAdmins);

                if ($adminResult && mysqli_num_rows($adminResult) > 0) {
                    while ($row = mysqli_fetch_assoc($adminResult)) {
                        echo "<tr>";
                        echo "<td>" . $row["ID"] . "</td>";
                        echo "<td>" . $row["AdminName"] . "</td>";
                        echo "<td>" . $row["Password"] . "</td>";
                        echo "<td>" . $row["Bankcode"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Sem administradores registrados.";
                }
                ?>
            </table>
        </main>
        <div class="login">
            <form id="signupForm" action="#" method="POST">
                <h2>Criar conta para administrador</h2>
                <div class="inputbox">
                    <input name="adminname" type="text" id="adminname" placeholder="Nome de Administrador" onkeyup="validateAdminname()">
                </div>
                <div class="error" id="adminnameError"></div>
                <div class="inputbox">
                    <input name="password" type="password" id="password" placeholder="Palavra-Passe" onkeyup="validatePassword()">
                </div>
                <div class="error" id="passwordError"></div>
                <div class="inputbox">
                    <input name="bankcode" type="number" id="bankcode" placeholder="Código bancário" onkeyup="validateBankcode()">
                </div>
                <div class="error" id="bankcodeError"></div>
                <button class="createbutton" type="submit" name="submit">Criar</button>
            </form>
        </div>
    </body>
</html>
