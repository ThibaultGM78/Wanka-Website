<?php
//Ce fichier php ajoute les informations relatives au nouvel utilisateur dans la base de donnees.
session_start();
//On recupere les donnees du formulaire.
$username = $_SESSION['username'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$adress = $_GET['adress'];

require '../sql/db-config.php';
try{
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);      

    $sql = "UPDATE wanka_account
        SET user_email = '".$email."',
            user_phone_number = '".$phone."',
            user_adress = '".$adress."'
        WHERE user_pseudo = '".$username."'";
    $request = $PDO->prepare($sql);
    //$request->bindValue(1, );
    $request->execute();    
}
catch(PDOExeption $pe){
    echo 'ERREUR : '.$pe->getMessage();
}

//On redirige l'utilisateur sur la page de connexion afin qu'il se connecte a son nouveau compte.
header('Location: ../index.php');
?>