function verifCoord(){//Cette fonction verifie que les informations donne par l'utilisateur pour la creation de son compte son correct.

    var validate = true; 
    
    //On verifie le format mail. Soit un nom, un "@"", une plateforme, un "." et une direction.
    if(document.getElementById("email").value.match(/[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.[a-z]+/i) == null){//sinon on affiche un message d'erreur.
        document.getElementById("email").className="formT1 error";//Le champ devient rouge.
        document.getElementById("errorEmail").className = "";//On affiche les attendues de la case qui etait auparavant cache.
        validate = false;//indique qu'il y a eu une erreur.
    }
    else{
        document.getElementById("email").className="formT1";//Le champ redevient normal.
        document.getElementById("errorEmail").className = "hide";//On cache les attendues de la case qui etait auparavant affiche.
    }
    /*Numero de telephone*/
    //On verifie le format telephone. Soit 10 chiffres.
    if(document.getElementById("phone").value.match(/^([0-9]){10}$/) == null){
        document.getElementById("phone").className="formT1 error";
        document.getElementById("errorPhone").className = "";
        validate = false;
    }
    else{
        document.getElementById("phone").className="formT1";
        document.getElementById("errorPhone").className = "hide";
    }
    /*Adress*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("adress").value == ""){
        document.getElementById("adress").className="formT1 error";
        document.getElementById("errorAdress").className = "";
        validate = false;
    }
    else{
        document.getElementById("adress").className="formT1";
        document.getElementById("errorAdress").className = "hide";
    }
    
   /*validate*/
   //Si validate = false le formulaire sera a corrige et ne passera pas a l'etape suivante.
   return validate;
   
}
