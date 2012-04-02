
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

function survole_personne_cache(event)
{
	var element = document.getElementById('liste_personnes_caches');
	var element2 = document.getElementById('personnes_caches');
	var curleft = curtop = 0;
	if (element2.offsetParent) {
		do {
			curleft += element2.offsetLeft;
			curtop += element2.offsetTop;
		} while (element2 = element2.offsetParent);
	}
	element.style.position = 'fixed';
	element.style.left = curleft+"px";
	element.style.top = curtop+15+"px";
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

function survole_profil_apercu(content)
{
	var element = content.querySelector('#profil_apercu');
	var element2 = content;
	var curleft = curtop = tmp = 0;
	if (element2.offsetParent) {
		do {
			if(element2.style.position != 'fixed')
			{
				tmp = element2.offsetTop;
				curtop += tmp;
			}
			else
			{
				curtop = element2.offsetTop+(tmp/2);
				curleft += 20;
			}
			curleft += element2.offsetLeft;
		} while (element2 = element2.offsetParent);
	}
	element.style.position = 'fixed';
	element.style.left = curleft+"px";
	element.style.top = curtop+15+"px";
	element.style.visibility='visible';
	element.style.height='auto';
	element.style.width='auto';
}
function quitte_profil_apercu(content)
{
	var element = content.querySelector('#profil_apercu');
	element.style.visibility='hidden';
	element.style.height='0px';
	element.style.width='0px';
}

function debloque_comment(num_comment)
{
	element = document.getElementById(num_comment);
	if(element.style.visibility != 'visible')
	{
		element.style.visibility = 'visible';
		element.style.width = "auto";
		element.style.height = "auto";
	}
	else
	{
		element.style.visibility = 'hidden';
		element.style.width = "0px";
		element.style.height = "0px";
	}		
}