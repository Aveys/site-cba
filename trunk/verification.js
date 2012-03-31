
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
		return false;
	}
	else{
		field.style.backgroundColor="green";
		return true;	
	}
}
function verifMdp(field){
	if(field.value == ""){
		field.style.backgroundColor="red";
		return false;
	}
	else{
		field.style.backgroundColor="green";
		return true;	
	}
}

function valid(){
	var texteField=document.blagues.texte; //on ne met pas le getElementById("ou"); car on n'a pas d'id="ou" dans notre formulaire.
	var pseudoField=document.blagues.pseudo; // idem, il faut id="nom" dans le forlmulaire.
	var texteOK = verifTexte(texteField);
	var pseudoOK = verifPseudo(pseudoField);
	return texteOK && pseudoOK;
}

function validLogin(field){
	var mdpField=field.mdp; //on ne met pas le getElementById("ou"); car on n'a pas d'id="ou" dans notre formulaire.
	var pseudoField=field.pseudo; // idem, il faut id="nom" dans le forlmulaire.
	return (verifPseudo(pseudoField) && verifMdp(mdpField));
}

function survole_personne_cache(event)
{
	if( window.event)
    	event = window.event;
	var x = event.clientX;
  	var y = event.clientY;
	var element = document.getElementById('liste_personnes_caches');
	element.style.position = 'fixed';
	element.style.left = x + 'px';
	element.style.top = y + 'px';
	element.style.visibility='visible';
	element.style.height='auto';
	element.style.width='auto';
}
function quitte_personne_cache()
{
	var element = document.getElementById('liste_personnes_caches');
	element.style.visibility='hidden';
	element.style.height='0px';
	element.style.width='0px';
}