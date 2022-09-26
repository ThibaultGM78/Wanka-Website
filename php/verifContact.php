<?php
//---Verification php des donnees donne par l'utilisateur.---//
    //Si le formaulaire est valide par l'utilisateur.
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //On recupere les donnees rentres par l'utilisateur.
        $contactDay = $_POST['contactDay'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $fonction = $_POST['fonction'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];
  
        //Fonction nous permettant de verifie si le format des dates donnee sont valide.
        function verifDate($date, $format = 'Y-m-d'){
            $dt = DateTime::createFromFormat($format, $date);
            return $dt && $dt->format($format) === $date;
        }

        //On creer un tableau ressencant les erreurs potentielles.
        $errors = [];

        //On verifie qu'il s'agit bien d'une date.
        if(!verifDate($contactDay)){
            $errors['contactDay'] = "error";//S'il y a une erreur on ressance qu'il y a une erreur a cet endroit-la.
        }
        //On verifie qu'il n'y a que des lettres //Remarque/Probleme: Les prenoms avec des caractere speciaux ne rentre pas.
        if(!preg_match('/^[a-zA-Z\-]+$/', $surname)){
            $errors['surname'] = "error";
        }
        //On verifie qu'il n'y a que des lettres //Remarque/Probleme: Les noms avec des caractere speciaux ne rentre pas.
        if(!preg_match('/^[a-zA-Z\-]+$/', $name)){
            $errors['name'] = "error";
        }
        //On verifie le format mail. Soit un nom, un "@"", une plateforme, un "." et une direction.
        if(!preg_match('/[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.[a-z]+/i', $email)){
            $errors['email'] = "error";
        }
        /*if($gender != "men" && $gender != "women"){
            $errors['gender'] = "error";
        }*/
        //On verifie qu'il s'agit bien d'une date.
        if(!verifDate($birthday)){
            $errors['birthday'] = "error";
        }
         //On verifie qu'une des 3 fonctions a ete coche.
        if($fonction != "teacher" && $fonction != "student" && $fonction != "other"){
            $errors['fonction'] = "error";
        }
        //On verifie que le champ n'est pas vide.
        if($subject == ""){
            $errors['subject'] = "error";
        }
        //On verifie que le champ n'est pas vide.
        if($content == ""){
            $errors['content'] = "error";
        }

        //Si le tableau contenant les erreurs est vide <=> Il n'y a aucune erreur.
        //On envoie le site recoit un "mail" avec toutes les informations rentre par l'utilisateur.
        if(empty($errors)){
            //On ouvre le ficher contenant les requetes des utilisateurs.
            $file = fopen('data/request/'.$email.'.txt','a+');
            //On ecrit le "mail".
            fwrite($file, $contactDay."\n".$name.' '.$surname."\n".$gender."\n".$birthday."\n".$fonction."\n".$subject."\n".$content."\n------\n");
            //On ferme le fichier.
            fclose($file);
            //On redirige l'utilisateur vers la page d'accueil.
            header("Location: index.php");
        }
    }
?>