<!--Ce fichier php comprend le header de tooutes les pages du site web-->
<!--Il est contenue dans une seul div, elle meme separe en 3 div-->
<div class="header">   
    <!--La premiere div contient le logo du site--> 
    <div class="header1"><img src="img/websiteLogo.png" class="logoHeader"></div>
    <!--La seconde div contient le nom du site, ainsi que la barre de navigation-->
    <div class="header2">
        <!--Premier sous-division contenent le titre du site-->
        <div class="header21"><h1 class="siteNameHeader">Wonka</h1></div>
         <!--Seconde sous-division contenant la barre de navigation du site-->
        <div class="header22">
  
            <!--Tableau contenant la barre de navigation du site.-->
            <!--On y place les categories du site, ainsi que la page d'accueil et la page de contact. On verifie que la page ou se situe l'utilisateur correspond a une des pages de cette barre de navigation afin de 
            d'y ajouter un effet de couleur si cela est le cas.        
            -->
            <table class="menu">
                <tr>                    
                    <td class="category" <?php if($_SERVER['PHP_SELF'] == '/index.php') echo'style="background: linear-gradient(0.5turn,antiquewhite, blueviolet)"'
                    //Se colorie si l'utilisateur se trouve sur la page d'accueil?>>
                    <a href="index.php" class="categoryLink">Accueil</a>
                    </td>

                    <?php
                        //On initialise la varible contenant les donnees du fichier XML.
                        include "data/categories.php";
                        $categories = new SimpleXMLElement($xmlstr);
                        //On utilise la variable nCategory contenant le nombre de categories, elle meme contenue dans le fichier XML afin de connaitre la longueur de la boucle for.
                        //On affiche chacune des categories dans le tableau.
                        for($i = 0; $i < $categories->nCategory; $i++){

                            //On verifie l'utilisateur se situe sur une page de vente. Seules les pages de ventes possedent une variable dans son URL afin de retrouve celle souhaite.
                            //Si c'est le cas on analysera chacune des categories afin de colorer celle ou se situe l'utilisateur.
                            if(!empty($_GET['cat'])) {
                                echo '<td class="category"';
                                if('c'.$categories->category[$i]->id == $_GET['cat']){
                                    echo' style="background: linear-gradient(0.5turn,antiquewhite, blueviolet)"';
                                } 
                                echo'><a href="category.php?cat=c'.$categories->category[$i]->id.'" class="categoryLink">'.$categories->category[$i]->name.'</a></td>';
                            }
                            //Sinon on affiche simplement chacune des categories.
                            else echo '<td class="category"><a href="category.php?cat=c'.$categories->category[$i]->id.'" class="categoryLink">'.$categories->category[$i]->name.'</a></td>';
                        }
                    ?>                      
                    <td class="category" <?php if($_SERVER['PHP_SELF'] == '/contact.php') echo'style="background: linear-gradient(0.5turn,antiquewhite, blueviolet)"'
                    //Se colorie si l'utilisateur se trouve sur la page de contact?>>
                    <a href="contact.php" class="categoryLink">Contact</a>
                    </td>
                </tr>
            </table>                                         
        </div>
    </div>
    <!--La troisieme div contient le nom du site, ainsi que la barre de navigation-->
    <div class="header3">
        <?php
            if(empty($_SESSION['username'])){//Si $_SESSION['username'] est vide alors l'utilisateur ne s'est pas connecte. On lui propose donc de se connecte.
                echo '<p><a href="connection.php" class="categoryLink">Connexion</a></p>';
            }
            else{//Sinon alors l'utilisateur est connecte. On affiche alors son pseuoonyme et on lui propose donc de se deconnecte si besoin.
                echo '<p><a href="modifyAccount.php" class="categoryLink">'.$_SESSION['username'].'</a></p>
                <p><a href="php/logout.php" class="categoryLink">Deconnexion</a></p>';
            }
        ?>
        <!--Lien permettant d'afficher son panier-->
        <p><a href="basket.php" class="categoryLink">Pannier</a></p>
    </div>
</div>