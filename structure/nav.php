<!--Ce fichier php affiche une liste de chacune des categories du site ainsi que la page d'accueil et la page de contact-->
<div class="main1">
    <!--Titre du site-->
    <h2 style="text-align: center;">Wonka</h2>
    <!--Lien permettant d'aller a la page d'accueil-->
    <p style="text-align: center;"><a href="index.php">Accueil</a></p>
    <hr>
    <!--liste de chacune des categories du site et de la page de contact avec les liens correspondant-->
    <h3 style="text-align: center; text-decoration: underline;">Nos produits</h3>
    <ul style="list-style-type: none;">
        <?php
            //On initialise la varible contenant les donnees du fichier XML.
            include "data/categories.php";
            $categories = new SimpleXMLElement($xmlstr);
            //On utilise la variable nCategory contenant le nombre de categories, elle meme contenue dans le fichier XML afin de connaitre la longueur de la boucle for.
            for($i = 0; $i < $categories->nCategory; $i++){
                echo '<li><a href="category.php?cat=c'.$categories->category[$i]->id.'">'.$categories->category[$i]->name.'</a></li>';                              
            }
        ?>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>