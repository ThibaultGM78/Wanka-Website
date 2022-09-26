function verifContact(){//Cette fonction verifie que les informations donne par l'utilisateur pour la prise de contact sont corrrect.

    var validate = true; 
    
    /*ContactDay*/
    //On verifie qu'il s'agit bien d'une date.
    let isValidDate = Date.parse(document.getElementById("contactDay").value);
    if(isNaN(isValidDate)){//sinon on affiche un message d'erreur.
        document.getElementById("contactDay").className="formT1 error";//sinon on affiche un message d'erreur.
        document.getElementById("errorContactDay").className = "";//Le champ devient rouge.
        validate = false;//indique qu'il y a eu une erreur.
    }
    else{//sioui
        document.getElementById("contactDay").className="";//Le champ redevient normal.
        document.getElementById("errorContactDay").className = "hide";//On cache les attendues de la case qui etait auparavant affiche.
    }
    /*Surname*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("surname").value.match(/^[a-zA-Z\-]+$/) == null){
        document.getElementById("surname").className="formT1 error";
        document.getElementById("errorSurname").className = "";
        validate = false;
    }
    else{
        document.getElementById("surname").className="formT1";
        document.getElementById("errorSurname").className = "hide";
    }
    /*Name*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("name").value.match(/^[a-zA-Z\-]+$/) == null){
        document.getElementById("name").className="formT1 error";
        document.getElementById("errorName").className = "";
        validate = false;
    }
    else{
        document.getElementById("name").className="formT1";
        document.getElementById("errorName").className = "hide";
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
    /*Subject*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("subject").value == ""){
        document.getElementById("subject").className="formT1 error";
        document.getElementById("errorSubject").className = "";
        validate = false;
    }
    else{
        document.getElementById("subject").className="formT1";
        document.getElementById("errorSubject").className = "hide";
    }   
    /*Content*/
    //On verifie que le champ n'est pas vide.
    if(document.getElementById("content").value == ""){
        document.getElementById("content").className="formT2 error";
        document.getElementById("errorContent").className = "";
        validate = false;
    }
    else{
        document.getElementById("content").className="formT1";
        document.getElementById("errorContent").className = "hide";
    }   
   /*validate*/
   //Si validate = false le formulaire sera a corrige et ne passera pas a l'etape suivante.
   return validate;
   
}