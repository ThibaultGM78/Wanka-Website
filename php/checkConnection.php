<?php
//Ce fichier php verifie si les informations de connexion rentrent par l'utilisateur sont corrects. Et le connecte ou non a son compte.
session_start();
//On recupere les donnee du formulaire
$username = $_GET['username'];
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

    $sql = 'SELECT * FROM wanka_account WHERE user_pseudo = ?';
    $request = $PDO->prepare($sql);
    $request->bindValue(1, $username);
    $request->execute();
    
    $userInfo = $request->fetch(PDO::FETCH_ASSOC);                        
    $userPassword = $userInfo['user_password']; 
    $role = $userInfo['user_role'];
    
    if($userPassword == $password){
        $_SESSION['username'] = $username;//La variable de session de l'utilisateur recois le pseudonyme de l'utilisateur.
        if($role == 'admin')  $_SESSION['role'] = 'admin';//On retient si l'utilisateur est un administrateur.

        header('Location: ../index.php');//L'utilisateur est redirige sur la page d'accueil du site.
    }
    else header('Location: ../connection.php');//L'utilisateur est redirige sur la page page de connexion du site afin de retenter sa chance.
  
}
catch(PDOExeption $pe){
    echo 'ERREUR : '.$pe->getMessage();
}
?>
