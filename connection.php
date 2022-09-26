<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wanka</title>
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
            <div class="centerDivMain2">
                <h2 style="text-align: center">Connexion</h2> 
                <!--Formulaire de connexion-->
                <form method="get" action="php/checkConnection.php">
                    <!--Contenue dans un tableau pour faire plus beau-->
                    <table style="text-align: left; width: 20%; margin-left: 40%;">
                        <tr><td>Nom d'utilisateur</td><td><input type="text" name="username"></td></tr>
                        <tr><td>Mot de passe</td><td><input type="password" name="password"></td></tr>
                        <tr><td></td><td style="text-align: right;"><input type="submit" name="valid_form" value="validate"></td></tr>
                    </table>
                </form>

                <!--Lien vers la page de creation de compte si l'utilisateur n'en posssede pas-->
                <a href="addClient.php" class="categoryLink">Créez un compte</a>
            </div>
        </div>
    </div>

    <!--On inclue le footer-->
    <?php include "structure/footer.php" ?>

</body>