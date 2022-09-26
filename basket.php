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
                $i = 0;
                echo '<table id="table" style="border: solid 1px; border-collapse: collapse;  width: 100%; height: 100%;">';
                echo'<tr><th class="catalogCell">Photo</th><th class="catalogCell">Reference</th><th class="catalogCell">Nombre</th><th class="catalogCell">Prix</th></tr>';
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
                        if($number > 0){
                            //On recupere la categorie de l'article.
                            $category = substr($ref, -3, 1);//On peut changer le "1" par un plus grands un plus grands nombre si nos catergories ont un nom superieur a une lettre.
        
                            //On recupere les donnees du produits
                            $sql = "SELECT * FROM wanka_c".$category." WHERE  chocolate_id ='".$ref."'";
                            $request = $PDO->prepare($sql);
                            $request->execute();
                            
                            $chocolateInfo = $request->fetch(PDO::FETCH_ASSOC); 
                            $chocolatePrice = $chocolateInfo['chocolate_price'];          
                            $chocolateImg = $chocolateInfo['chocolate_img']; 
                        
                            //On retient le prix de toute les un unite de l'article contenue dans le panier.
                            $groupRate = $chocolatePrice * $number;

                            //On recupere le stock disponible
                            $sql = "SELECT * FROM wanka_stocks WHERE chocolate_id ='".$ref."'";
                            $request = $PDO->prepare($sql);
                            $request->execute();
                            
                            $WankaStock = $request->fetch(PDO::FETCH_ASSOC);                        
                            $stock = $WankaStock['chocolate_stock'];     
                            
        
                            //On creer le visuel montrant la presence de l'article et son nombre d'unites conteneur dans le panier de l'utilisateur.
                            echo '<tr id="element'.$i.'">
                                <td class="catalogCell"><img src="'.$chocolateImg.'" id="item"></td>
                                <td class="catalogCell">'.$actual[0].'</td>              
                                <td class="catalogCell">
                                    <button type="button" onclick="minus('.$i.')">-</button>
                                    <input id="stockV'.$i.'" type="hidden" value="'.$stock.'" disabled>
                                    <input name="number" class="displayNumber" id="basket'.$i.'" value="'.$number.'" disabled>
                                    <input type="hidden" id="ref'.$i.'" value="'.$ref.'">                       
                                    <button type="button" onclick="plus('.$i.')">+</button>  
                                    <br> 
                                    <button type="button" onclick="deleteElement('.$i.')">Suprimer</button> 
                                </td>
                                <td class="catalogCell">
                                    <input type="hidden" id="price'.$i.'" value="'.$chocolatePrice.'">
                                    <input name="number" class="displayNumber" id="group'.$i.'" value="'.$groupRate.'" disabled>€
                                </td>
                            </tr>';
                        }
                        //On passe a l'element suivant.
                        $i++;
                    }
                }
                catch(PDOExeption $pe){
                    echo 'ERREUR : '.$pe->getMessage();
                }    

                //On ferme le tableau.
                echo '</table>';

                //si l'utilisateur s'est connecte on lui propose de payer. Sinon on lui propose de se connecter. En le redirigent vers les pages correspondantes.
                if(empty($_SESSION['username'])) echo '<p><a href="connection.php"><input type="button" value="Se connecter pour payer"></a></p>';
                else echo '<p><a href="payment.php"><input type="button" value="Payer"></a></p>'
            
            ?>
        </div>
    </div>

    <!--On inclue le footer-->
    <?php include "structure/footer.php" ?>
</body>