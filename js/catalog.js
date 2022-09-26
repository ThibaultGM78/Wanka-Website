function displayStock(n){//Cette fonction affiche ou chache les stocks.

    //On recupere la classe de la case correspondant au stock du premier element.
    var clas = document.getElementById('stock1').className;
    //On regarde si le stock du premier element du tableau est cache <=> class="hide".
    if(clas == "hide") {//Si c'est le cas on change la classe de chacune des cases ccorrespondant au stock du tableau afin de les afficher.
        for(var i = 0; i < n;i++){
            document.getElementById("stock"+i).className = "catalogCell";
        }
    }
    else{//Si c'est le cas on change la classe de chacune des cases ccorrespondant au stock du tableau afin de les cacher.
        for(var i = 0; i < n;i++){
            document.getElementById("stock"+i).className = "hide";
        }
    }
}

function minus(n){//Cette fonction retire un au nombre d'unite de cette article contenue dans le panier de l'utilisateur et ajoute un au nombre d'unite de cette article present en stock.
    //On recupere le nombre d'unite de cette article contenue dans le panier. 
    var x = Number( document.getElementById("basket"+n).value);

    //Si il reste au moins une unite de cette article dans le panier.
    if(x > 0) {
        //1)---Cette partie est purement de l'affichage---//
            //L'affichage contenant le nombre de produits deja dans le panier recoit moins un.
            document.getElementById("basket"+n).value =  x - 1;
            //L'affichage cache contenant le nombre de produits encore en stock recoit plus un.      
            document.getElementById("stockV"+n).value = Number( document.getElementById("stockV"+n).value) + 1;
        //------//
        //2)---AJAX, Cette modife le panier de l'utilisateur et les stocks du site---//
            //On recupere la reference du produit afin de pouvoir la transmettre la reference de l'article a l'operation suivante.
            ref = document.getElementById("ref"+n).value;
            //On creer l'AJAX.
            var xhr = new XMLHttpRequest();
            //On verifie qu'il n'y a pas de probleme.  
            xhr.onreadystatechange = function() {
                                    
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.response);
                }
                else if(this.readyState == 4){
                    alert("error");
                }
            };
            //On appelle la fonction php qui mettra a jour les donnee de stock est de panier.                        
            xhr.open("POST", "php/minus.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("ref="+ref);//On passe la reference de l'article en parametre.
        //------//    
    }
}   

function plus(n){//Cette fonction ajoute un au nombre d'unite de cette article contenue dans le panier de l'utilisateur et retire un au nombre d'unite de cette article present en stock.
    //On recupere le nombre d'unite de cette article contenue dans le panier. 
    var x = Number( document.getElementById("basket"+n).value);
    //On recupere le nombre d'unite de cette article encore en stock.
    var stock = Number( document.getElementById("stockV"+n).value);

    //Si il reste au moins une unite de cette article en stock.
    if(0 < stock) {

        //1)---Cette partie est purement de l'affichage---//
            //L'affichage contenant le nombre de produits deja dans le panier recoit plus un.
            document.getElementById("basket"+n).value = x + 1;
            //L'affichage cache contenant le nombre de produits encore en stock recoit moins un.
            document.getElementById("stockV"+n).value = Number( document.getElementById("stockV"+n).value) - 1;
        //------//    
        //2)---AJAX, Cette modife le panier de l'utilisateur et les stocks du site---//
            //On recupere la reference du produit afin de pouvoir la transmettre la reference de l'article a l'operation suivante.
            var ref = document.getElementById("ref"+n).value;
            //On creer l'AJAX.
            var xhr = new XMLHttpRequest();
            //On verifie qu'il n'y a pas de probleme.                                
            xhr.onreadystatechange = function() {                                  
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.response);
                }
                else if(this.readyState == 4){
                    alert("error");
                }
            };
            //On appelle la fonction php qui mettra a jour les donnee de stock est de panier.                    
            xhr.open("POST", "php/plus.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("ref="+ref);//On passe la reference de l'article en parametre.
        //------//
    }
}  