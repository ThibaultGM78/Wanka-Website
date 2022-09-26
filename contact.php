<?php
    session_start();
    //On inclue la verification php du formulaire de contact.
    //On l'inclue ici car nous utilisaons la methode post.
    //Nous utilisons la methde post afin de reafficher les donnees correctes de l'utilisateur en cas d'erreur sur d'autres.
    include "php/verifContact.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wanka</title>
    <!--On inclue le fichier css-->
    <link rel="stylesheet" href="css/index.css">
    <!--On inclue le fichier javascript contenant les fonctions liee a la page php-->
    <script src="js/verifContact.js"></script>
</head>
<body class="body">
    <!--On inclue l'header-->
    <?php include "structure/header.php" ?>

    <div class="main">
        <!--On inclue le nav-->
        <?php include "structure/nav.php" ?>

        <div class="main2">
            <div class="centerDivMain2">         
                <h2 style="text-align: center">Demande de contact</h2> 
                <!--Le formulaire regroupant les questions nessaicaire a la demande de contact-->
                <form method="post" onsubmit="return verifContact()" >
                    <table class="formTable"> 
                        <!--contactDay-->
                        <tr><td class="formC1">Date de contact</td>
                            <td>
                                <input type="date" id="contactDay" name="contactDay" 
                                    <?php if (isset($errors['contactDay'])) echo'class="error"'
                                    //S'il y a une erreur la classe de la case du tableau changera et le champ sera colore en rouge. Signifiant la presence d'une erreur.
                                    ?> 
                                    class="" value="<?= $_POST['contactDay'] ?? ''//On retient l'information precedement rentree si cette derniere est correcte?>">
                                <span id="errorContactDay" <?php if (isset($errors['contactDay'])) echo'class=""'?> class="hide">La date de votre mise en relation avec le service client n'est pas valide.</span>
                            </td>
                        </tr>
                        <!--Surame-->
                        <tr><td class="formC1">Nom</td>
                            <td>
                                <input type="text" id="surname"  name="surname"  <?php if (isset($errors['surname'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['surname'] ?? '' ?>" placeholder="Entrez votre nom">
                                <span id="errorSurname" <?php if (isset($errors['surname'])) echo'class=""'?> class="hide">Votre nom de famille n'est pas valide. Veuillez utiliser des carateres compris entre A et Z.</span>
                                
                            </td>
                        <tr>
                        <!--Name-->
                        <tr><td class="formC1">Prénom</td>
                            <td>
                                <input type="text" id="name" name="name" <?php if (isset($errors['name'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['name'] ?? '' ?>" placeholder="Entrez votre prénom">
                                <span id="errorName" <?php if (isset($errors['name'])) echo'class=""'?> class="hide">Votre prenom n'est pas valide. Veuillez utiliser des carateres compris entre A et Z.</span>
                            </td>
                        <tr>
                        <!--Email-->
                        <tr><td class="formC1">Email</td>
                        <td>
                            <input type="email" id="email" name="email" <?php if (isset($errors['email'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['email'] ?? '' ?>" placeholder="monmail@monsite.org">
                            <span id="errorEmail" <?php if (isset($errors['email'])) echo'class=""'?> class="hide">Votre adresse mail n'est pas valide.</span>
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
                        <!--Subject-->
                        <tr><td class="formC1">Sujet :</td>
                            <td>
                                <input type="text" id="subject" name="subject" <?php if (isset($errors['subject'])) echo'class="formT1 error"'?> class="formT1" value="<?= $_POST['subject'] ?? '' ?>" placeholder="Entrez le sujet de votre mail">
                                <span id="errorSubject" <?php if (isset($errors['subject'])) echo'class=""'?> class="hide">Veuillez entrer le sujet de votre mail</span>
                            </td>
                        <tr>
                        <!--Content-->
                        <tr><td class="formC1">Contenu</td>
                            <td>
                                <textarea id="content" name="content" <?php if (isset($errors['content'])) echo'class="formT2 error"'?> class="formT2" placeholder="Entrez ici votre mail"><?= $_POST['content'] ?? '' ?></textarea>
                                <span id="errorContent" <?php if (isset($errors['content'])) echo'class=""'?> class="hide">Veuillez entrer le contenue de votre mail</span>
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