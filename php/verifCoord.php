<?php
//---Verification php des donnees donne par l'utilisateur.---//
    //Si le formaulaire est valide par l'utilisateur.
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //On recupere les donnees rentres par l'utilisateur.
        $username = $_SESSION['username'];     
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
    
        //On creer un tableau ressencant les erreurs potentielles.
        $errors = [];

        //On verifie le format mail. Soit un nom, un "@"", une plateforme, un "." et une direction.
        if(!preg_match('/[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.[a-z]+/i', $email)){
            $errors['email'] = "error";
        }
        //On verifie que le champ n'est pas vide.
        if($adress == ""){
            $errors['adress'] = "error";
        }
        //On verifie le format telephone. Soit 10 chiffres.
        if(!preg_match('/^([0-9]){10}$/', $phone)){
            $errors['phone'] = "error";
        }
        
        //Si le tableau contenant les erreurs est vide <=> Il n'y a aucune erreur.
        //On envoie les informations au fichier php qui va recenser le nouveau compte dans la base de donnees du site.
        if(empty($errors)){
            header('Location: php/saveCoord.php?email='.$email.'&phone='.$phone.'&adress='.$adress);
        }
    }
?>