
function verifTexte(field){
	if(field.value==""){
		field.className ="erreur";
		return false;
	}
	else{
		field.className ="valid";
		return true;	
	}
}
function verifPseudo(field){
	if(field.value==""){
		field.className ="erreur";
		field.value = "Login";
		return false;
	}
	else{
		field.className ="valid";
		return true;	
	}
}
function modifPseudo(field){
	field.value = "";
}
function verifMdp(field){
	if(field.value == ""){
		field.className ="erreur";
		field.value = "Mots de passe";
		field.type = "text";
		return false;
	}
	else{
		field.className ="valid";
		return true;	
	}
}
function modifMdp(field){
	if(field.type == "text")
		field.type = "password";
	field.value = "";
}

function verifMail(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}


function valid(){
	var texteField=document.articles.texte; //on ne met pas le getElementById("ou"); car on n'a pas d'id="ou" dans notre formulaire.
	var pseudoField=document.articles.pseudo; // idem, il faut id="nom" dans le forlmulaire.
	var texteOK = verifTexte(texteField);
	var pseudoOK = verifPseudo(pseudoField);
	return texteOK && pseudoOK;
}

function validLogin(field){
	var mdpField=field.mdp; //on ne met pas le getElementById("ou"); car on n'a pas d'id="ou" dans notre formulaire.
	var pseudoField=field.pseudo; // idem, il faut id="nom" dans le forlmulaire.
	return (verifPseudo(pseudoField) && verifMdp(mdpField));
}

function validCompte(field)
{
	if(verifPseudo(field.pseudo) && verifMail(field.mail) && verifMdp(field.password))
		return true;
	else
		return false;
}
function fermeture(requete,methode)
{
    if (window.XMLHttpRequest)
    {
        xhr_object = new XMLHttpRequest();
        xhr_object.open(methode, requete, true);
        xhr_object.send(null);
        xhr_object.onreadystatechange = function() 
        { 
            if(xhr_object.readyState == 4) 
            {
                alert(xhr_object.responseText);
            }
        }
    }
    else if(window.ActiveXObject)
    {
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
        xhr_object.open(methode, requete, true);
        xhr_object.send(null);
        if(xhr_object.readyState == 4) 
        {
            alert(xhr_object.responseText);
        }
    }
    else
    {
        alert('Votre navigateur ne supporte pas les objets XMLHTTPRequest...');
        return(false);
    }
    alert('1');
}
//BLABLA kk
$(document).ready(function(){
	$('#formConnexion').hide()
});
