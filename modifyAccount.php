<?php
    session_start();

    require 'sql/db-config.php';
    try{
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);

        $sql = "SELECT * FROM wanka_account WHERE user_pseudo ='".$_SESSION['username']."'";
        $request = $PDO->prepare($sql);
        $request->execute();
        
        $userInfo = $request->fetch(PDO::FETCH_ASSOC);                        
        $email = $userInfo['user_email']; 
        $phone = $userInfo['user_phone_number'];
        $adress = $userInfo['user_adress'];
    
    }
    catch(PDOExeption $pe){
        echo 'ERREUR : '.$pe->getMessage();
    }    
           

    //On inclue la verification php du formulaire de creation de compte.
    //On l'inclue ici car nous utilisaons la methode post.
    //Nous utilisons la methde post afin de reafficher les donnees correctes de l'utilisateur en cas d'erreur sur d'autres.
    include "php/verifCoord.php";  
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Wanka</title>
<!--On inclue le fichier css-->
<link rel="stylesheet" href="css/index.css">
<!--On inclue le fichier javascript contenant les fonctions liee a la page php-->
<script src="js/verifCoord.js"></script>
</head>
<body class="body">

<!--On inclue l'header-->
<?php include "structure/header.php" ?>

<div class="main">       
    <!--On inclue le nav-->
    <?php include "structure/nav.php" ?>

    <div class="main2">
        <div class="centerDivMain2">
            <h2 style="text-align: center">Modifier ses coordonnées</h2> 
            <!--Le formulaire regroupant les questions nessaicaire a la creation d'un compte-->
            <form method="post" onsubmit="return verifCoord()">
                <table class="formTable">                   
                    <!--Email-->
                    <tr><td class="formC1">Email</td>
                    <td>
                        <input type="email" id="email" name="email" <?php if (isset($errors['email'])) echo'class="formT1 error"'?> class="formT1" <?php echo 'value="'.$email.'"'; if (isset($errors['email'])) echo'value="'. $_POST['email'].'"'; ?> placeholder="monmail@monsite.org">
                        <span id="errorEmail" <?php if (isset($errors['email'])) echo'class=""'?> class="hide">Votre adresse mail n'est pas valide.</span>
                        </td>
                    <tr>
                    <!--Numero de telephone-->
                    <tr><td class="formC1">Numero de telephone</td>
                    <td>
                        <input type="tel" id="phone" name="phone" <?php if (isset($errors['phone'])) echo'class="formT1 error"'?> class="formT1" <?php echo 'value="'.$phone.'"'; if (isset($errors['phone'])) echo'value="'. $_POST['phone'].'"'; ?> placeholder="Entrez votre numero  de telephone">
                        <span id="errorPhone" <?php if (isset($errors['phone'])) echo'class=""'?> class="hide">Votre numero de telephone n'est pas valide.</span>
                        </td>
                    <tr>
                    <!--Adress-->
                    <tr><td class="formC1">Adresse</td>
                        <td>
                            <input type="text" id="adress" name="adress" <?php if (isset($errors['adress'])) echo'class="formT1 error"'?> class="formT1" <?php echo 'value="'.$adress.'"'; if (isset($errors['adress'])) echo'value="'. $_POST['adress'].'"'; ?> placeholder="Entrez votre adresse">
                            <span id="errorAdress" <?php if (isset($errors['adress'])) echo'class=""'?> class="hide">Votre prenom n'est pas valide. Veuillez utiliser des carateres compris entre A et Z.</span>
                        </td>
                    <tr>
                    <tr><td></td><td style="text-align: right;"><button type="submit">Envoyer</button></td></tr>
                </table> 
            </form>
            <h2 style="text-align: center">Historique de facture</h2> 
            <?php
                //On afiche toutes les factures du client.
                $file = fopen('data/facture/'.$email.'.txt', "r");
                while ($line = fgets($file)) {
                   echo $line."<br>";
                }
                fclose($file);
            ?>
        </div>
    </div>
</div>

<!--On inclue le footer-->
<?php include "structure/footer.php" ?>    
</body>
