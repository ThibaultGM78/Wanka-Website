<?php
//---Verification php des donnees donne par l'utilisateur.---//
    //Si le formaulaire est valide par l'utilisateur.
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //On recupere les donnees rentres par l'utilisateur.
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $adress = $_POST['adress'];
        $fonction = $_POST['fonction'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        //On creer un tableau ressencant les erreurs potentielles.
        $errors = [];

        //Fonction nous permettant de verifie si le format des dates donnee sont valide.
        function verifDate($date, $format = 'Y-m-d'){
            $dt = DateTime::createFromFormat($format, $date);
            return $dt && $dt->format($format) === $date;
        }

        //On verifie que le champ n'est pas vide.
        if($username == ""){
            $errors['username'] = "error";//S'il y a une erreur on ressance qu'il y a une erreur a cet endroit-la.
        }
        //On verifie le format mail. Soit un nom, un "@"", une plateforme, un "." et une direction.
        if(!preg_match('/[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.[a-z]+/i', $email)){
            $errors['email'] = "error";
        }
        //On verifie qu'il s'agit bien d'une date.
        if(!verifDate($birthday)){
            $errors['birthday'] = "error";
        }
        //On verifie que le champ n'est pas vide.
        if($adress == ""){
            $errors['adress'] = "error";
        }
        //On verifie le format telephone. Soit 10 chiffres.
        if(!preg_match('/^([0-9]){10}$/', $phone)){
            $errors['phone'] = "error";
        }
        //On verifie qu'une des 3 fonctions a ete coche.
        if($fonction != "teacher" && $fonction != "student" && $fonction != "other"){
            $errors['fonction'] = "error";
        }
        //On verifie que le champ n'est pas vide.
        if($password == ""){
            $errors['password'] = "error";
        }
        //On verifie qu'est les deux mot passes soit les memes.
        if($password2 != $password){
            $errors['password2'] = "error";
        }
    
        //Si le tableau contenant les erreurs est vide <=> Il n'y a aucune erreur.
        //On envoie les informations au fichier php qui va recenser le nouveau compte dans la base de donnees du site.
        if(empty($errors)){
            header('Location: php/saveAccount.php?username='.$username.'&email='.$email.'&phone='.$phone.'&gender='.$gender.'&birthday='.$birthday.'&adress='.$adress.'&fonction='.$fonction.'&password='.$password);
        }
    }
?>