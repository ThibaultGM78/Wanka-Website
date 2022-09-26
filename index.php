<?php
    session_start();
    //On creer le panier de l'utilisateur. Qui sera stocke dans les donnees de session sous format JSON.
    if(empty($_SESSION['basket'])) {
        $_SESSION['basket'] = "{}";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wonka</title>
    <!--On inclue le fichier css-->
    <link rel="stylesheet" href="css/index.css"> 
</head>
<body class="body">
    <!--On inclue l'header-->
    <?php include "structure/header.php" ?>

    <div class="main">
        <!--On inclue le nav-->
        <?php include "structure/nav.php" ?>

        <div class="main2">
            <!--PAge d'accueil du site-->
            <div class="centerDivMain2">

            <h1>Chaque chocolat est un ticket d'or</h1>
            <img src="img/websiteLogo.png" class="logoMain2"><br>
            <p>Appelez notre service commercial au 03.22.84.65.74 pour recevoir un bon de commande</p>

            </div>

        </div>
    </div>
    
    <!--On inclue le footer-->
    <?php include "structure/footer.php" ?>
</body>