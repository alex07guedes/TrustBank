<?php

@include "database.php";
session_start();

$wallet_error = "";
$error = "";
$bank_error = "";

if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];

    $select = "SELECT balance FROM user WHERE name = '$name'";
    $result = mysqli_query($database, $select);

    $get_balance = mysqli_fetch_assoc($result);
    $balance = $get_balance["balance"];

    if(isset($_POST["deposit"])){
        $amount_deposit = mysqli_real_escape_string($database, $_POST["amount_deposit"]);
        $balance = "UPDATE user SET balance = balance + $amount_deposit WHERE name = '$name'";
        mysqli_query($database, $balance);
    }
    else if(isset($_POST["withdraw"])){
        $amount_withdraw = mysqli_real_escape_string($database, $_POST["amount_withdraw"]);

        if($balance >= $amount_withdraw && $balance != "0"){
            $balance = "UPDATE user SET balance = balance - $amount_withdraw WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $wallet_error = "Saldo Insuficiente! Por favor deposite dinheiro.";
        }
    }

    $select = "SELECT balance FROM user WHERE name = '$name'";
    $result = mysqli_query($database, $select);

    $get_balance = mysqli_fetch_assoc($result);
    $balance = $get_balance["balance"];

    if(isset($_POST["buyBTC"])){
        $btc_num = mysqli_real_escape_string($database, $_POST["btc_num_buy"]);
        $btc_value = $btc_num * 26460;

        if($balance >= $btc_value && $balance != "0"){
            $btc_balance = "UPDATE user SET btc_balance = btc_balance + $btc_value WHERE name = '$name'";
            mysqli_query($database, $btc_balance);

            $btc_amount = "UPDATE user SET btc_amount = btc_amount + $btc_num WHERE name = '$name'";
            mysqli_query($database, $btc_amount);

            $balance = "UPDATE user SET balance = balance - $btc_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Saldo Insuficiente! Por favor deposite dinheiro.";
        }
    }
    else if(isset($_POST["sellBTC"])){
        $btc_num = mysqli_real_escape_string($database, $_POST["btc_num_sell"]);
        $btc_value = $btc_num * 26460;
        
        $selectBTC_amount = "SELECT btc_amount FROM user WHERE name = '$name'";
        $resultBTC_amount = mysqli_query($database, $selectBTC_amount);
    
        $get_btc_amount = mysqli_fetch_assoc($resultBTC_amount);
        $btc_amount = $get_btc_amount["btc_amount"];

        if($btc_amount >= $btc_num && $btc_amount > 0){
            $btc_balance = "UPDATE user SET btc_balance = btc_balance - $btc_value WHERE name = '$name'";
            mysqli_query($database, $btc_balance);

            $btc_amount = "UPDATE user SET btc_amount = btc_amount - $btc_num WHERE name = '$name'";
            mysqli_query($database, $btc_amount);

            $balance = "UPDATE user SET balance = balance + $btc_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Número de Bitcoins Insuficiente! Por favor compre Bitcoins.";
        }
    }

    $selectBTC_amount = "SELECT btc_amount FROM user WHERE name = '$name'";
    $resultBTC_amount = mysqli_query($database, $selectBTC_amount);

    $get_btc_amount = mysqli_fetch_assoc($resultBTC_amount);
    $btc_amount = $get_btc_amount["btc_amount"];

    $selectBTC = "SELECT btc_balance FROM user WHERE name = '$name'";
    $resultBTC = mysqli_query($database, $selectBTC);

    $get_btc_balance = mysqli_fetch_assoc($resultBTC);
    $btc_balance = $get_btc_balance["btc_balance"];

    $selectBalance = "SELECT balance FROM user WHERE name = '$name'";
    $resultBalance = mysqli_query($database, $selectBalance);

    $get_balance = mysqli_fetch_assoc($resultBalance);
    $balance = $get_balance["balance"];

    if(isset($_POST["buyETH"])){
        $eth_num = mysqli_real_escape_string($database, $_POST["eth_num_buy"]);
        $eth_value = $eth_num * 1838;

        if($balance >= $eth_value && $balance != "0"){
            $eth_balance = "UPDATE user SET eth_balance = eth_balance + $eth_value WHERE name = '$name'";
            mysqli_query($database, $eth_balance);

            $eth_amount = "UPDATE user SET eth_amount = eth_amount + $eth_num WHERE name = '$name'";
            mysqli_query($database, $eth_amount);

            $balance = "UPDATE user SET balance = balance - $eth_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Saldo Insuficiente! Por favor deposite dinheiro.";
        }
    }
    else if(isset($_POST["sellETH"])){
        $eth_num = mysqli_real_escape_string($database, $_POST["eth_num_sell"]);
        $eth_value = $eth_num * 1838;

        $selectETH_amount = "SELECT eth_amount FROM user WHERE name = '$name'";
        $resultETH_amount = mysqli_query($database, $selectETH_amount);
    
        $get_eth_amount = mysqli_fetch_assoc($resultETH_amount);
        $eth_amount = $get_eth_amount["eth_amount"];

        if($eth_amount >= $eth_num && $eth_amount > 0){
            $eth_balance = "UPDATE user SET eth_balance = eth_balance - $eth_value WHERE name = '$name'";
            mysqli_query($database, $eth_balance);

            $eth_amount = "UPDATE user SET eth_amount = eth_amount - $eth_num WHERE name = '$name'";
            mysqli_query($database, $eth_amount);

            $balance = "UPDATE user SET balance = balance + $eth_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Número de Ethereum Insuficiente! Por favor compre Ethereum.";
        }
    }

    $selectETH_amount = "SELECT eth_amount FROM user WHERE name = '$name'";
    $resultETH_amount = mysqli_query($database, $selectETH_amount);

    $get_eth_amount = mysqli_fetch_assoc($resultETH_amount);
    $eth_amount = $get_eth_amount["eth_amount"];

    $selectETH = "SELECT eth_balance FROM user WHERE name = '$name'";
    $resultETH = mysqli_query($database, $selectETH);

    $get_eth_balance = mysqli_fetch_assoc($resultETH);
    $eth_balance = $get_eth_balance["eth_balance"];

    $selectBalance = "SELECT balance FROM user WHERE name = '$name'";
    $resultBalance = mysqli_query($database, $selectBalance);

    $get_balance = mysqli_fetch_assoc($resultBalance);
    $balance = $get_balance["balance"];
    

    if(isset($_POST["buyLTC"])){
        $ltc_num = mysqli_real_escape_string($database, $_POST["ltc_num_buy"]);
        $ltc_value = $ltc_num * 89;

        if($balance >= $ltc_value && $balance != "0"){
            $ltc_balance = "UPDATE user SET ltc_balance = ltc_balance + $ltc_value WHERE name = '$name'";
            mysqli_query($database, $ltc_balance);

            $ltc_amount = "UPDATE user SET ltc_amount = ltc_amount + $ltc_num WHERE name = '$name'";
            mysqli_query($database, $ltc_amount);

            $balance = "UPDATE user SET balance = balance - $ltc_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Saldo Insuficiente! Por favor deposite dinheiro.";
        }
    }
    else if(isset($_POST["sellLTC"])){
        $ltc_num = mysqli_real_escape_string($database, $_POST["ltc_num_sell"]);
        $ltc_value = $ltc_num * 89;

        $selectLTC_amount = "SELECT ltc_amount FROM user WHERE name = '$name'";
        $resultLTC_amount = mysqli_query($database, $selectLTC_amount);
    
        $get_ltc_amount = mysqli_fetch_assoc($resultLTC_amount);
        $ltc_amount = $get_ltc_amount["ltc_amount"];

        if($ltc_amount >= $ltc_num && $ltc_amount > 0){
            $ltc_balance = "UPDATE user SET ltc_balance = ltc_balance - $ltc_value WHERE name = '$name'";
            mysqli_query($database, $ltc_balance);

            $ltc_amount = "UPDATE user SET ltc_amount = ltc_amount - $ltc_num WHERE name = '$name'";
            mysqli_query($database, $ltc_amount);

            $balance = "UPDATE user SET balance = balance + $ltc_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Número de Litecoins Insuficiente! Por favor compre Litecoins.";
        }
    }

    $selectLTC_amount = "SELECT ltc_amount FROM user WHERE name = '$name'";
    $resultLTC_amount = mysqli_query($database, $selectLTC_amount);

    $get_ltc_amount = mysqli_fetch_assoc($resultLTC_amount);
    $ltc_amount = $get_ltc_amount["ltc_amount"];

    $selectLTC = "SELECT ltc_balance FROM user WHERE name = '$name'";
    $resultLTC = mysqli_query($database, $selectLTC);

    $get_ltc_balance = mysqli_fetch_assoc($resultLTC);
    $ltc_balance = $get_ltc_balance["ltc_balance"];

    $selectBalance = "SELECT balance FROM user WHERE name = '$name'";
    $resultBalance = mysqli_query($database, $selectBalance);

    $get_balance = mysqli_fetch_assoc($resultBalance);
    $balance = $get_balance["balance"];

    if(isset($_POST["buySOL"])){
        $sol_num = mysqli_real_escape_string($database, $_POST["sol_num_buy"]);
        $sol_value = $sol_num * 18;

        if($balance >= $sol_value && $balance != "0"){
            $sol_balance = "UPDATE user SET sol_balance = sol_balance + $sol_value WHERE name = '$name'";
            mysqli_query($database, $sol_balance);

            $sol_amount = "UPDATE user SET sol_amount = sol_amount + $sol_num WHERE name = '$name'";
            mysqli_query($database, $sol_amount);

            $balance = "UPDATE user SET balance = balance - $sol_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Saldo Insuficiente! Por favor deposite dinheiro.";
        }
    }
    else if(isset($_POST["sellSOL"])){
        $sol_num = mysqli_real_escape_string($database, $_POST["sol_num_sell"]);
        $sol_value = $sol_num * 18;

        $selectSOL_amount = "SELECT sol_amount FROM user WHERE name = '$name'";
        $resultSOL_amount = mysqli_query($database, $selectSOL_amount);
    
        $get_sol_amount = mysqli_fetch_assoc($resultSOL_amount);
        $sol_amount = $get_sol_amount["sol_amount"];

        if($sol_amount >= $sol_num && $sol_amount > 0){
            $sol_balance = "UPDATE user SET sol_balance = sol_balance - $sol_value WHERE name = '$name'";
            mysqli_query($database, $sol_balance);

            $sol_amount = "UPDATE user SET sol_amount = sol_amount - $sol_num WHERE name = '$name'";
            mysqli_query($database, $sol_amount);

            $balance = "UPDATE user SET balance = balance + $sol_value WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $error = "Número de Solana Insuficiente! Por favor compre Solana.";
        }
    }

    $selectSOL_amount = "SELECT sol_amount FROM user WHERE name = '$name'";
    $resultSOL_amount = mysqli_query($database, $selectSOL_amount);

    $get_sol_amount = mysqli_fetch_assoc($resultSOL_amount);
    $sol_amount = $get_sol_amount["sol_amount"];

    $selectSOL = "SELECT sol_balance FROM user WHERE name = '$name'";
    $resultSOL = mysqli_query($database, $selectSOL);

    $get_sol_balance = mysqli_fetch_assoc($resultSOL);
    $sol_balance = $get_sol_balance["sol_balance"];

    $selectBalance = "SELECT balance FROM user WHERE name = '$name'";
    $resultBalance = mysqli_query($database, $selectBalance);

    $get_balance = mysqli_fetch_assoc($resultBalance);
    $balance = $get_balance["balance"];

    if(isset($_POST["bankPay"])){
        $pay = mysqli_real_escape_string($database, $_POST["pay"]);

        if($balance >= $pay && $balance > 0){
            $balance = "UPDATE user SET balance = balance - $pay WHERE name = '$name'";
            mysqli_query($database, $balance);
        }
        else{
            $bank_error= "Saldo Insuficiente! Por favor deposite dinheiro.";
        }

    }

    $selectBalance = "SELECT balance FROM user WHERE name = '$name'";
    $resultBalance = mysqli_query($database, $selectBalance);

    $get_balance = mysqli_fetch_assoc($resultBalance);
    $balance = $get_balance["balance"];

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../static/user.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TrustBank</title>
        <script src="https://kit.fontawesome.com/795a734e49.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;500;700&display=swap" rel="stylesheet">
        <script defer src="../scripts/user.js"></script>
    </head>
    <body>
        <header>
            <div class="name">
                <h1>Bem vindo, <span style="color: #00ffff"><?php echo $name ?></span> !</h1>
            </div>
            <div class="logout">
                <a href="login.php">Terminar Sessão</a>
            </div>
        </header>
        <main>
            <div class="wallet-error">
                <p><?php echo $wallet_error ?></p>
            </div>
            <section class="wallet">
                <div class= "wallet-container">
                    <div class="wallet-info">
                        <h3>Detalhes da Conta</h3>
                        <h1><?php echo $balance ?>.00 €</h1>
                        <h4>Saldo</h4>

                        <div class="wallet-btns">
                            <button onclick="displayDeposit()" class="deposit">Depositar</button>
                            <button onclick="displayWithdraw()" class="withdraw">Levantar</button>
                        </div>
                        <div class="wallet-form">
                            <form id="showDeposit" action="user.php" method="POST">
                                <label>Montante a Depositar</label>
                                <div class="inputbox">
                                    <input name="amount_deposit" id="amount" type="number" required min="0"></input>
                                    <button name="deposit" id="teste" type="submit" onclick="teste"><i class="fa-solid fa-arrow-right"></i></button>
                                </div>
                            </form>
                            <form id="showWithdraw" action="user.php" method="POST">
                                <label>Montante a Levantar</label>
                                <div class="inputbox">
                                    <input name="amount_withdraw" type="number" required min="0">
                                    <button name="withdraw" type="submit"><i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="popular-crypto">
                    <h1>CryptoMoedas</h1>
                    <div class="crypto-container">
                        <div class="crypto">
                            <div class="crypto-name">
                                <img src="../images/crypto1.png" style="width:40%">
                                <h3>Bitcoin</h3>
                            </div>
                            <div class="price">
                                <h4>26460€</h4>
                                <p>-155.60(0,67%)</p>
                            </div>
                        </div>
                        <div class="crypto">
                            <div class="crypto-name">
                                <img src="../images/crypto2.png" style="width:40%">
                                <h3>Ethereum</h3>
                            </div>
                            <div class="price">
                                <h4>1838€</h4>
                                <p>-12.517(0,70%)</p>
                            </div>
                        </div>
                        <div class="crypto">
                            <div class="crypto-name">
                                <img src="../images/crypto3.png" style="width:40%">
                                <h3>Litecoin</h3>
                            </div>
                            <div class="price">
                                <h4>89€</h4>
                                <p style="color:green">+0.953(1,11%)</p>
                            </div>
                        </div>
                        <div class="crypto">
                            <div class="crypto-name">
                                <img src="../images/crypto4.png" style="width:40%">
                                <h3>Solana</h3>
                            </div>
                            <div class="price">
                                <h4>18€</h4>
                                <p>-1.374(7,36%)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="crypto-wallets">
                    <h1>Carteiras Crypto</h1>
                    <p><?php echo $error ?></p>
                    <div class="cryptowallet-container">
                        <div class="cryptowallet">
                            <div class="wallet-header">
                                <div class="cryptowallet-name">
                                    <img src="../images/crypto1.png" style="width:16%">
                                    <h2>Bitcoin</h2>
                                </div>
                                <div class="crypto-short">
                                    <h2>BTC</h2>
                                </div>
                            </div>
                            <div class="wallet-body">
                                <h1><?php echo $btc_amount ?></h1>
                                <h4>Número de Bitcoins</h4>
                                <h1><?php echo $btc_balance ?>.00 €</h1>
                                <h4>Valor das Bitcoins</h4>
                                <div class="crypto-btns">
                                    <button onclick="displayBuyBTC()" id="buyBTC" class="buy">Comprar</button>
                                    <button onclick="displaySellBTC()" id="sellBTC" class="sell">Vender</button>
                                </div>
                                <div class="crypto-form">
                                    <form id="showBuyBTC" action="user.php" method="POST">
                                        <label>Número de Bitcoins</label>
                                        <div class="inputbox">
                                            <input name="btc_num_buy" type="number" required min="1" style="width:74%"></input>
                                            <button name="buyBTC" type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="crypto-form">
                                    <form id="showSellBTC" action="user.php" method="POST">
                                        <label>Número de Bitcoins</label>
                                        <div class="inputbox">
                                            <input name="btc_num_sell" type="number" required min="1" style="width:74%">
                                            <button name="sellBTC" type="submit"><i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cryptowallet">
                            <div class="wallet-header">
                                <div class="cryptowallet-name">
                                    <img src="../images/crypto2.png" style="width:16%">
                                    <h2>Ethereum</h2>
                                </div>
                                <div class="crypto-short">
                                    <h2>ETH</h2>
                                </div>
                            </div>
                            <div class="wallet-body">
                                <h1><?php echo $eth_amount ?></h1>
                                <h4>Número de Ethers</h4>
                                <h1><?php echo $eth_balance ?>.00 €</h1>
                                <h4>Valor do Ethereum</h4>
                                <div class="crypto-btns">
                                    <button onclick="displayBuyETH()" class="buy">Comprar</button>
                                    <button onclick="displaySellETH()" class="sell">Vender</button>
                                </div>
                                <div class="crypto-form">
                                    <form id="showBuyETH" action="user.php" method="POST">
                                        <label>Número de Ethers</label>
                                        <div class="inputbox">
                                            <input name="eth_num_buy" type="number" required min="1" style="width:74%"></input>
                                            <button name="buyETH" type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                    <form id="showSellETH" action="user.php" method="POST">
                                        <label>Número de Ethers</label>
                                        <div class="inputbox">
                                            <input name="eth_num_sell" type="number" required min="1" style="width:74%">
                                            <button name="sellETH" type="submit"><i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cryptowallet">
                            <div class="wallet-header">
                                <div class="cryptowallet-name">
                                    <img src="../images/crypto3.png" style="width:16%">
                                    <h2>Litecoin</h2>
                                </div>
                                <div class="crypto-short">
                                    <h2>LTC</h2>
                                </div>
                            </div>
                            <div class="wallet-body">
                                <h1><?php echo $ltc_amount ?></h1>
                                <h4>Número de Litecoins</h4>
                                <h1><?php echo $ltc_balance ?>.00 €</h1>
                                <h4>Valor das Litecoins</h4>
                                <div class="crypto-btns">
                                    <button onclick="displayBuyLTC()" class="buy">Comprar</button>
                                    <button onclick="displaySellLTC()" class="sell">Vender</button>
                                </div>  
                                <div class="crypto-form">
                                    <form id="showBuyLTC" action="user.php" method="POST">
                                        <label>Número de Litecoins</label>
                                        <div class="inputbox">
                                            <input name="ltc_num_buy" type="number" required min="1" style="width:74%"></input>
                                            <button name="buyLTC" type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                    <form id="showSellLTC" action="user.php" method="POST">
                                        <label>Número de Litecoins</label>
                                        <div class="inputbox">
                                            <input name="ltc_num_sell" type="number" required min="1" style="width:74%">
                                            <button name="sellLTC" type="submit"><i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cryptowallet">
                            <div class="wallet-header">
                                <div class="cryptowallet-name">
                                    <img src="../images/crypto4.png" style="width:16%">
                                    <h2>Solana</h2>
                                </div>
                                <div class="crypto-short">
                                    <h2>SOL</h2>
                                </div>
                            </div>
                            <div class="wallet-body">
                                <h1><?php echo $sol_amount ?></h1>
                                <h4>Número de Solana</h4>
                                <h1><?php echo $sol_balance ?>.00 €</h1>
                                <h4>Valor da Solana</h4>
                                <div class="crypto-btns">
                                    <button onclick="displayBuySOL()" class="buy">Comprar</button>
                                    <button onclick="displaySellSOL()" class="sell">Vender</button>
                                </div>
                                <div class="crypto-form">
                                    <form  id="showBuySOL" action="user.php" method="POST">
                                        <label>Número de Solana</label>
                                        <div class="inputbox">
                                            <input name="sol_num_buy" type="number" required min="1" style="width:74%"></input>
                                            <button name="buySOL" type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                    <form id="showSellSOL" action="user.php" method="POST">
                                        <label>Número de Solana</label>
                                        <div class="inputbox">
                                            <input name="sol_num_sell" type="number" required min="1" style="width:74%">
                                            <button name="sellSOL" type="submit"><i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="payment-methods">
                <div class="payments">
                    <h1>Pagamentos com o TrustBank</h1>
                    <div class="payments-error">
                        <p><?php echo $bank_error ?></p>
                    </div>
                    <h6>Escolha um método de pagamento:</h6>
                    <div class="payment-container">
                        <div class="payment-img">
                            <img src="../images/payment1.png">
                        </div>
                        <div class="payment">
                            <div class="payment-text">
                                <h2>Tranferência Bancária</h2>
                                <p>Simplifique suas transações financeiras com Transferências Bancárias eficientes e confiáveis, proporcionando uma gestão financeira precisa e sem complicações.</p>
                            </div>
                        </div>
                        <button onclick="openBankForm()"><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                    <div class="payment-container">
                        <div class="payment-img">
                            <img src="../images/payment2.png">
                        </div>
                        <div class="payment">
                            <div class="payment-text">
                                <h2>Cartão de Crédito/Débito</h2>
                                <p>Os Cartões de Crédito/Débito são uma ferramenta essencial para realizar transações seguras, aproveitar benefícios exclusivos e conquistar uma maior flexibilidade financeira.</p>
                            </div>
                        </div>
                        <button onclick="openCreditForm()"><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>
                <div class="payment-forms">
                    <div class="payments-form">
                        <form id="bankForm" class="bank-form" method="POST">
                            <h1>Transferência Bancária</h1>
                            <div class="bankinput">
                                <label>Nome do Banco</label>
                                <input type="text" placeholder="TrustBank" required>
                            </div>
                            <div class="bankinput">
                                <label>IBAN</label>
                                <input type="number" placeholder="0018 XXXX XXXX XXXX XXXX X" required min="0">
                            </div>
                            <div class="bankinput">
                                <label>BIC/SWIFT</label>
                                <input type="text" placeholder="TSBIPTPL" required>
                            </div>
                            <div class="bankinput">
                                <label>Valor a Pagar</label>
                                <input name="pay" type="number" required min="0">
                            </div>
                            <button name="bankPay" type="submit">Pagar</button>
                        </form>
                    </div>
                    <div class="payments-form">
                        <form id="creditForm" class="bank-form" method="POST">
                            <h1>Cartão de Crédito/ Débito</h1>
                            <div class="bankinput">
                                <label>Número do Cartão</label>
                                <input type="number" placeholder="1234567890123456" required>
                            </div>
                            <div class="bankinput">
                                <label>Data de Validade</label>
                                <input type="date" placeholder="MM/YY" required min="0">
                            </div>
                            <div class="bankinput">
                                <label>CVC/CVV</label>
                                <input type="number" placeholder="123" required min="0">
                            </div>
                            <div class="bankinput">
                                <label>Valor a Pagar</label>
                                <input name="pay" type="number" required min="0">
                            </div>
                            <button name="bankPay" type="submit">Pagar</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
