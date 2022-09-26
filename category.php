<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wanka</title>
    <!--On inclue le fichier css-->
    <link rel="stylesheet" href="css/index.css">
    <!--On inclue le fichier javascript contenant les fonctions liee a la page php-->
    <script src="js/catalog.js"></script>
</head>

<body class="body">
    <!--On inclue l'header-->
    <?php include "structure/header.php" ?>
    
    <div class="main">
        <!--On inclue le nav-->
        <?php include "structure/nav.php" ?>
        
        <div class="main2">

            <?php
                //Creation du tableau contenant les articles a vendre.
                echo '<table id="table" style="border: solid 1px; border-collapse: collapse;  width: 100%; height: 100%">';
                echo'<tr><th class="catalogCell">Photo</th><th class="catalogCell">Réferences</th><th class="catalogCell">Description</th><th class="catalogCell">Prix</th><th id="stock0" class="hide">Stock</th><th class="catalogCell">Commandes</th></tr>';
        
                //On recupere le panier contenue sous forme JSON dans la variable $_SESSION['basket']. 
                $data = $_SESSION['basket'];
                $basket = json_decode($data);

                //SQL
                require 'sql/db-config.php';
                try{
                    $options = [
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ];
            
                    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);
            
                    //On recupere les donnees de la categorie
                    $sql = 'SELECT * FROM wanka_'.$_GET['cat'];
                    $results = $PDO->prepare($sql);
                    $results->execute();

                    $listChocolate = $results->fetchALL(PDO::FETCH_ASSOC);
                    $results->closeCursor();
                    
                    $id_chocolate = 1;
                    foreach($listChocolate as $chocolate){
                
                        $i = $id_chocolate;
                        $ref = $chocolate['chocolate_id'];
                        $price = $chocolate['chocolate_price'];
                        $img = $chocolate['chocolate_img'];
                        $des = $chocolate['chocolate_description'];

                        //On recupere le stock disponible
                        $sql = "SELECT * FROM wanka_stocks WHERE chocolate_id = '".$ref."'";
                        $request = $PDO->prepare($sql);
                        $request->execute();
                        
                        $WankaStock = $request->fetch(PDO::FETCH_ASSOC);                        
                        $stock = $WankaStock['chocolate_stock'];         

                        //On recupere le nombre d'unite de chaque produits deja present dans le panier de l'utilisateur.
                        //On initialise la variable suivante a 0 car le JSON contenent le panier de l'utilisateur ne contient que les produits ayant ete ajoute au moins une fois au panier.
                        $basketElement = 0;
                        //Si une variable corespondante a l'article est presente dans le JSON contenant le panier <=> L'utilisateur a deja eu une unite de ce produit dans son panier.
                        //Alors on recupere le nombre d'unites de l'article actuellement present dans le panier de l'utilisateur.
                        if(!empty($basket->$ref)){
                            $basketElement = $basket->$ref;
                        }
                        
                        //S'il reste au moins une unite de l'article en stock alors on affiche le visuel contente toutes les informations le concernant.
                        //Les $i nous nous permettrons de pouvoir recuperer simplement les info de chaque article en les differenciant facilement.
                        if($stock > 0) {
                            echo '<tr>
                            <td class="catalogCell"><img src="'.$img.'" id="item"></td>
                            <td class="catalogCell">'.$ref.'</td>
                            <td class="catalogCell">'.$des.'</td>
                            <td class="catalogCell">'.$price.'€</td>
                            <td id="stock'.$i.'" class="hide"><input id="stockV'.$i.'" class="displayNumber" value="'.$stock.'" disabled></td>
                            <td class="catalogCell">                          
                                <button type="button" onclick="minus('.$i.')">-</button>
                                <input name="number" class="displayNumber" id="basket'.$i.'" value="'.$basketElement.'" disabled>
                                <input type="hidden" id="ref'.$i.'" value="'.$ref.'">
                                <button type="button" onclick="plus('.$i.','.$stock.')">+</button>               
                            </td></tr>';

                            $id_chocolate++;
                        }                       
                    }
 
                }
                catch(PDOExeption $pe){
                    echo 'ERREUR : '.$pe->getMessage();
                }
                
                //On clos le tableau.
                echo'</table>';
 
                //On verfie si la variable de session role existe. 
                if(!empty($_SESSION['role'])){
                    //On verifie que le role de l'utilisateur correspond a administrateur.
                    if($_SESSION['role'] == "admin"){
                        //On affiche le bouton qui affiche les stocks
                        echo '<p><button type="button" onclick="displayStock('.$i.')">Stock</button></p>';
                    }      
                }                         
            ?>        
        </div>
    </div>

    <!--On inclue le footer-->
    <?php include "structure/footer.php" ?>
</body>