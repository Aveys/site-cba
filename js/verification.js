
function verifTexte(field){
	if(field.value==""){
		field.style.backgroundColor="red";
		return false;
	}
	else{
		field.style.backgroundColor="green";
		return true;	
	}
}
function verifPseudo(field){
	if(field.value==""){
		field.style.backgroundColor="red";
		field.value = "Login";
		return false;
	}
	else{
		field.style.backgroundColor="green";
		return true;	
	}
}
function modifPseudo(field){
	field.value = "";
}
function verifMdp(field){
	if(field.value == ""){
		field.style.backgroundColor="red";
		field.value = "Mots de passe";
		field.type = "text";
		return false;
	}
	else{
		field.style.backgroundColor="green";
		return true;	
	}
}
function modifMdp(field){
	if(field.type == "text")
		field.type = "password";
	field.value = "";
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