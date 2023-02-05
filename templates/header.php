<?php 
    include_once("process/conn.php");
    $msg = "";

    if(isset($_SESSION["msg"])){

        $msg = $_SESSION["msg"];
        $status = $_SESSION["status"];

        $_SESSION["msg"] = "";
        $_SESSION["status"] = "";

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon">
    <title>Hamburgueria</title>
    <!--css-->
    <link rel="stylesheet" href="css/styles.css">
    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header class="header">

        <nav class="navbar">
            <a href="index.php" class="navbar-brand">
                <img src="img/icone.png" alt="hamburgueria">
            </a>
            <div class="menu">
                <ul>
                    <li>
                        <a href="form.php">Faça o seu Pedido</a>
                    </li>
                    
                </ul>

            </div>
        </nav> 
    </header>

    <?php
        if($msg != "") : ?>
            <div class="alert-success-<?=$status ?>">
                <p> <?=$msg ?> </p>
            </div>
    <?php endif ?>

  