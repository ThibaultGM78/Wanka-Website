<?php
    session_start();
    //On inclue la verification php du formulaire de creation de compte.
    //On l'inclue ici car nous utilisaons la methode post.
    //Nous utilisons la methde post afin de reafficher les donnees correctes de l'utilisateur en cas d'erreur sur d'autres.
    include "php/verifAccount.php";  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wanka</title>
    <!--On inclue le fichier css-->
    <link rel="stylesheet" href="css/index.css">
    <!--On inclue le fichier javascript contenant les fonctions liee a la page php-->
    <script src="js/verifAccount.js"></script>
</head>
<body class="body">

    <!--On inclue l'header-->
    <?php include "structure/header.php" ?>

    <div class="main">       
        <!--On inclue le nav-->
        <?php include "structure/nav.php" ?>

        <div class="main2">
            <div class="centerDivMain2">
                <h2 style="text-align: center">Créer un compte</h2> 
                <!--Le formulaire regroupant les questions nessaicaire a la creation d'un compte-->
                <form method="post" onsubmit="return verifAccount()">
                    <table class="formTable"> 
                        <!--Name-->
                        <tr><td class="formC1">Nom d'utilisateur</td>
                            <td>
                                <input type="text" id="username" name="username" 
                                    <?php 
                                    if (isset($errors['username'])) echo'class="formT1 error"'
                                    //S'il y a une erreur la classe de la case du tableau changera et le champ sera colore en rouge. Signifiant la presence d'une erreur.
                                    ?>
                                    class="formT1" value="<?= $_POST['username'] ?? ''//On retient l'information precedement rentree si cette derniere est correcte?>" placeholder="Entrez votre prénom">
                                <span id="errorUsername" <?php if (isset($errors['username'])) echo'class=""'?> class="hide">Votre prenom n'est pas valide. Veuillez utiliser des carateres compris entre A et Z.</span>
                            </td>
                        <tr>
                        <!--Email-->
                        <tr><td class="formC1">Email</td>
                        <td>
                            <input type="email" id="email" name="email" <?php if (isset($errors['email'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['email'] ?? '' ?>" placeholder="monmail@monsite.org">
                            <span id="errorEmail" <?php if (isset($errors['email'])) echo'class=""'?> class="hide">Votre adresse mail n'est pas valide.</span>
                            </td>
                        <tr>
                        <!--Numero de telephone-->
                        <tr><td class="formC1">Numero de téléphone</td>
                        <td>
                            <input type="tel" id="phone" name="phone" <?php if (isset($errors['phone'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['phone'] ?? '' ?>" placeholder="Entrez votre numero  de telephone">
                            <span id="errorPhone" <?php if (isset($errors['phone'])) echo'class=""'?> class="hide">Votre numero de telephone n'est pas valide.</span>
                            </td>
                        <tr>
                        <!--Gender-->
                        <tr><td class="formC1">Genre</td>
                            <td>
                                <span id="gender" class=""><input type="radio" id="gender1" name="gender" value="women">Femme<input type="radio" id="gender2" name="gender" value="men">Homme<input type="radio" name="gender" class="hide" value="null" checked></span>
                                <span id="errorGender" class="hide">Veuillez selectionner un genre.</span>
                            </td>
                        <tr>
                        <!--Birthday-->
                        <tr><td class="formC1">Date de naissance</td>
                            <td>
                                <input type="date" id="birthday" name="birthday" <?php if (isset($errors['birthday'])) echo'class="error"'?> class="" value="<?= $_POST['birthday'] ?? '' ?>">
                                <span id="errorBirthday" <?php if (isset($errors['birthday'])) echo'class=""'?> class="hide">Votre date d'anniversaire n'est pas valide.</span>
                            </td>
                        <tr>
                        <!--Adress-->
                        <tr><td class="formC1">Adresse</td>
                            <td>
                                <input type="text" id="adress" name="adress" <?php if (isset($errors['adress'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['adress'] ?? '' ?>" placeholder="Entrez votre adresse">
                                <span id="errorAdress" <?php if (isset($errors['adress'])) echo'class=""'?> class="hide">Votre prenom n'est pas valide. Veuillez utiliser des carateres compris entre A et Z.</span>
                            </td>
                        <tr>
                        <!--Fonction-->
                        <tr><td class="formC1">Fonction</td>
                            <td>
                                <select id="fonction" name="fonction">
                                    <option value="teacher">Enseignant</option>
                                    <option value="student">Eleve</option>
                                    <option value="other">Autre</option>
                                </select>
                                <span id="errorFonction" <?php if (isset($errors['fonction'])) echo'class=""'?> class="hide">Veuillez selectionner une fonction.</span>
                            </td>
                        <tr>
                        <!--Mot de passe-->
                        <tr><td class="formC1">Mot de passe</td>
                        <td>
                            <input type="password" id="password" name="password" <?php if (isset($errors['password'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['password'] ?? '' ?>" placeholder="mot de passe">
                            <span id="errorPassword" <?php if (isset($errors['password'])) echo'class=""'?> class="hide">Veuillez rentrer un mot de passe</span>
                            </td>
                        <tr>
                        <!--Verification Mot de passe-->
                        <tr><td class="formC1">Confirmer votre mot de passe</td>
                        <td>
                            <input type="password" id="password2" name="password2" <?php if (isset($errors['password2'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['password2'] ?? '' ?>" placeholder="confirmer votre mot de passe">
                            <span id="errorPassword2" <?php if (isset($errors['password2'])) echo'class=""'?> class="hide">Veuillez confirmer votre mot de passe</span>
                            </td>
                        <tr>
                        <tr><td></td><td style="text-align: right;"><button type="submit">Envoyer</button></td></tr>
                    </table> 
                </form>     
            </div>
        </div>
    </div>

    <!--On inclue le footer-->
    <?php include "structure/footer.php" ?>    
</body>