<?php
//Ce fichier php ajoute les informations relatives au nouvel utilisateur dans la base de donnees.
session_start();
//On recupere les donnees du formulaire.
$username = $_GET['username'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$gender = $_GET['gender'];
$birthday = $_GET['birthday'];
$adress = $_GET['adress'];
$fonction = $_GET['fonction'];
$password = $_GET['password'];

//SQL

require '../sql/db-config.php';
try{
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);      

    $sql = "INSERT INTO `wanka_account`(`user_pseudo`, `user_password`, `user_email`, `user_phone_number`, `user_sexe`, `user_birthday`, `user_adress`, `user_job`, `user_role`)
    VALUES
    ('".$username."','".$password."','".$email."','".$phone."','".$gender."','".$birthday."','".$adress."','".$fonction."','');";
    
    $request = $PDO->prepare($sql);
    $request->execute();    
}
catch(PDOExeption $pe){
    echo 'ERREUR : '.$pe->getMessage();
}

//On redirige l'utilisateur sur la page de connexion afin qu'il se connecte a son nouveau compte.
header('Location: ../connection.php');

?>