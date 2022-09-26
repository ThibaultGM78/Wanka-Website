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
    <script src="js/basket.js"></script>
</head>
<body class="body">
    <!--On inclue l'header-->
    <?php include "structure/header.php" ?>

    <div class="main">
        <!--On inclue le nav-->
        <?php include "structure/nav.php" ?>

        <div class="main2">

            <?php
                //On recupere le panier contenue sous forme JSON dans la variable $_SESSION['basket']. 
                $dataBasket = $_SESSION['basket'];
                //On retire les caractere "{","}" et """ afin de creer un tableau ou chaque compartiment contient un article et le nombre d'unite de ce dernier mis au panier par l'utilisateur.
                $basket = preg_replace('({)', '', $dataBasket);
                $basket = preg_replace('(})', '', $basket);
                $basket = preg_replace('(")', '', $basket);
                $element = explode(",",$basket);
                
                
                //Creation du tableau
                $finalPrice = 0;
                $i = 0;
                echo '<table id="table" style="border: solid 1px; border-collapse: collapse;  width: 100%; height: 100%;">';
                echo'<tr><th class="catalogCell">Reference</th><th class="catalogCell">Nombre</th><th class="catalogCell">Prix</th><th class="catalogCell">Prix TTC</th></tr>';
                //Tant qu'il reste un element a afficher dans le panier.
                require 'sql/db-config.php';
                try{
                    $options = [
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ];
                    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);  

                    while(!empty($element[$i])){

                        //On separe les compartiments en deux plus petits car auparavant un seul compartiment contentenait la reference de l'article et le nombre d'unite de ce dernier mis au panier par l'utilisateur.
                        $actual = explode(":", $element[$i]);
                        $ref = $actual[0];
                        $number = $actual[1];

                        //S'il y'a au moins une unite de cet article present dans le panier de l'utilisateur. On l'affiche visuellement dans le panier.
                        $groupeRateIncludingTaxe = 0;
                        if($number > 0){
                            //On recupere la categorie de l'article.
                            $category = substr($ref, -3, 1);//On peut changer le "1" par un plus grands un plus grands nombre si nos catergories on nom superieur a une lettre.
                           
                            //On recupere les donnees du produits
                            $sql = "SELECT * FROM wanka_c".$category." WHERE  chocolate_id ='".$ref."'";
                            $request = $PDO->prepare($sql);
                            $request->execute();
                            
                            $chocolateInfo = $request->fetch(PDO::FETCH_ASSOC); 
                            $chocolatePrice = $chocolateInfo['chocolate_price'];          
                        
                            //On retient le prix de HTC toute les un unite de l'article contenue dans le panier.
                            $groupRate = $chocolatePrice * $number;
                            //On retient le prix TTC de toute les un unite de l'article contenue dans le panier
                            $groupeRateIncludingTaxe = $groupRate*1.20;
                            
                            //On creer le visuel montrant la presence de l'article et son nombre d'unites conteneur dans le panier de l'utilisateur.
                            echo '<tr>
                                <td class="catalogCell">'.$actual[0].'</td>              
                                <td class="catalogCell">'.$number.'</td>
                                <td class="catalogCell">'.$groupRate.'€</td>
                                <td class="catalogCell">'.$groupeRateIncludingTaxe.'€</td>
                            </tr>'; 
                        }
                        //On addittionne le prix de chaque ligne pour obtenir le prix final.
                        $finalPrice += $groupeRateIncludingTaxe;
                        $i++; 
                    }
                }
                catch(PDOExeption $pe){
                    echo 'ERREUR : '.$pe->getMessage();
                } 

                //On affiche le prix final et on propose de payer.
                echo'<tr><td colspan="4" class="catalogCell"><p>Prix final: '.$finalPrice.'€ <a href="php/transaction.php"><input type="button" value="Payer"></a></p></tr>';
                //On ferme le tableau.
                echo '</table>';
            ?>        
        </div>
    </div>
    <!--On inclue le footer-->
    <?php include "structure/footer.php" ?>

</body>