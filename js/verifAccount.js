function verifAccount(){//Cette fonction verifie que les informations donne par l'utilisateur pour la creation de son compte son correct.

    var validate = true; 
    
    /*Userame*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("username").value == ""){//sinon on affiche un message d'erreur.
        document.getElementById("username").className="formT1 error";//Le champ devient rouge.
        document.getElementById("errorUsername").className = "";//On affiche les attendues de la case qui etait auparavant cache.
        validate = false;//indique qu'il y a eu une erreur.
    }
    else{//sioui
        document.getElementById("username").className="formT1";//Le champ redevient normal.
        document.getElementById("errorUsername").className = "hide";//On cache les attendues de la case qui etait auparavant affiche.
    }
    /*Email*/
    //On verifie le format mail. Soit un nom, un "@"", une plateforme, un "." et une direction.
    if(document.getElementById("email").value.match(/[a-z0-9_\-\.]+@[a-z0-9_\-\.]+\.[a-z]+/i) == null){
        document.getElementById("email").className="formT1 error";
        document.getElementById("errorEmail").className = "";
        validate = false;
    }
    else{
        document.getElementById("email").className="formT1";
        document.getElementById("errorEmail").className = "hide";
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
    /*Gender*/
    //On verifie qu'une des deux cases a ete coche.
    if(!document.getElementById("gender1").checked && !document.getElementById("gender2").checked){
        document.getElementById("gender").className="error";
        document.getElementById("errorGender").className = "";
        validate = false;
    }
    else{
        document.getElementById("gender").className="";
        document.getElementById("errorGender").className ="hide";
    }
    /*Birthay*/
    //On verifie qu'il s'agit bien d'une date.
    let isValidDate2 = Date.parse(document.getElementById("birthday").value);
    if(isNaN(isValidDate2)){
        document.getElementById("birthday").className="formT1 error";
        document.getElementById("errorBirthday").className = "";
        validate = false;
    }
    else{
        document.getElementById("birthday").className="";
        document.getElementById("errorBirthday").className = "hide";
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
    /*Fonction*/
    //On verifie qu'une des 3 fonctions a ete coche.
    if(document.getElementById("fonction").value != "teacher" && document.getElementById("fonction").value != "student" && document.getElementById("fonction").value != "other"){
        document.getElementById("fonction").className="error";
        document.getElementById("errorFonction").className = "";
        validate = false;
    }
    else{
        document.getElementById("fonction").className="";
        document.getElementById("errorFonction").className ="hide";
    }
    /*Password*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("password").value == ""){
        document.getElementById("password").className="formT1 error";
        document.getElementById("errorPassword").className = "";
        validate = false;
    }
    else{
        document.getElementById("password").className="formT1";
        document.getElementById("errorPassword").className = "hide";
    }  
    /*VerifPassword*/
    //On verifie qu'est les deux mot passes soit les memes.
    if(document.getElementById("password2").value != document.getElementById("password").value){
        document.getElementById("password2").className="formT1 error";
        document.getElementById("errorPassword2").className = "";
        validate = false;
    }
    else{
        document.getElementById("password2").className="formT1";
        document.getElementById("errorPassword2").className = "hide";
    }
   /*validate*/
   //Si validate = false le formulaire sera a corrige et ne passera pas a l'etape suivante.
   return validate;
}
