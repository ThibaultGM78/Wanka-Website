<?php
    //Ce fichier php envoie au mail de l'utilisiteur une facture.
    session_start();
    //On recupere le pseudonyme de l'utilisateur.
    $username = $_SESSION['username'];

    require '../sql/db-config.php';
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

        //On ouvre ou creer le fichier contenant les factures de l'utilisateur (A defaut d'envoyer un mail) en mode ecriture a la suite.
        $file = fopen('../data/facture/'.$email.'.txt','a+');

        //On y ecrit l'objet du mail.
        fwrite($file, "Facture wanka\n------\n");
    
        //On recupere les donnees du panier contenue dans $_SESSION['basket'].
        $dataBasket = $_SESSION['basket'];

        //On cherche a ecrire dans la facture un resume de chacun des articles compris dedans et son nombre de produits achete. Pour cela on va convertire le JSON en tableau en elevant les caracetere "{","}" et """.
        $basket = preg_replace('({)', '', $dataBasket);
        $basket = preg_replace('(})', '', $basket);
        $basket = preg_replace('(")', '', $basket);
        $element = explode(",",$basket);

        //---Creation du tableau---
        $finalPrice = 0;//Le prix final y est stocke.
        $i = 0;
        while(!empty($element[$i])){//Tant que le panier possede encore un elements a afficher.

            //On creer un tableau contenant les donnees de l'element. Et distribue les donnees y etant contenue.
            $actual = explode(":", $element[$i]);
            $ref = $actual[0];
            $number = $actual[1];

            //Si il y a au moins un produits de l'article analyse.
            if($number > 0){

                //On separe la categorie et le numero du produit contnenue dans la variable $ref.
                $category = substr($ref, -3, 1);//On peut changer le "1" par un plus grands un plus grands nombre si nos catergories on nom superieur a une lettre.
               
                //On recupere les donnees du produits
                $sql = "SELECT * FROM wanka_c".$category." WHERE  chocolate_id ='".$ref."'";
                $request = $PDO->prepare($sql);
                $request->execute();
                
                $chocolateInfo = $request->fetch(PDO::FETCH_ASSOC); 
                $chocolatePrice = $chocolateInfo['chocolate_price'];          

                //Prix de l'article en fonction du nombre de ce dernier dans le panier.
                $groupRate = $chocolatePrice * $number;
                //Prix TTC de l'article en fonction du nombre de ce dernier dans le panier.
                $groupeRateIncludingTaxe = $groupRate*1.20;
                //On ecrit dans la facture le prix HTTC et TTC de l'article en fonction du nombre de ce dernier dans le panier en dettaillant les calculs.
                fwrite($file, $actual[0].'*'.$number.'= '.$groupRate.'€|TTC: '.$groupeRateIncludingTaxe."€|TVA= 20%\n");
            }
            //AU fur et a mesure on ajoute le prix de l'article en fonction du nombre de ce dernier dans le panier au prix final.
            $finalPrice += $groupeRateIncludingTaxe;
            $i++;  
        }

        //Fin du mail.
        fwrite($file, $finalPrice."€.\n------\n");
        //On ferme le fichier correspondant au mail envoyer a l'utilisateur.
        fclose($file);
        //On reinitialise le panier car il a ete payer.
        unset($_SESSION['basket']);
        //On reinitialise le panier car il a ete payer.
        header("Location: ../index.php");  
    }
    catch(PDOExeption $pe){
        echo 'ERREUR : '.$pe->getMessage();
    } 
?>