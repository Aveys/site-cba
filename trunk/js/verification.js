<<<<<<< .minefunction verifMdp(field)
{
	if(field.value == '')
	{
=======
function verifTexte(field){
	if(field.value==""){
		field.className ="erreur";
>>>>>>> .theirs		return false;
	}
<<<<<<< .mine	else
	{
		return true;
=======	else{
		field.className ="valid";
		return true;	
>>>>>>> .theirs	}
}
<<<<<<< .mine
function verifMail(field)
{
	if(field.value == '')
	{
=======function verifPseudo(field){
	if(field.value==""){
		field.className ="erreur";
		field.value = "Login";
>>>>>>> .theirs		return false;
	}
<<<<<<< .mine	else
	{
		return true;
=======	else{
		field.className ="valid";
		return true;	
>>>>>>> .theirs	}
}
<<<<<<< .mine
function verifPseudo(field)
{
	if(field.value == '')
	{
=======function modifPseudo(field){
	field.value = "";
}
function verifMdp(field){
	if(field.value == ""){
		field.className ="erreur";
		field.value = "Mots de passe";
		field.type = "text";
>>>>>>> .theirs		return false;
	}
<<<<<<< .mine	else
	{
		return true;
=======	else{
		field.className ="valid";
		return true;	
>>>>>>> .theirs	}
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
function validCompte(field)
{
	if(verifLogin(field.pseudo) && verifMail(field.email) && verifPseudo(field.pseudo) && verifMdp(field.password) && verifStatus(field.status))
		return true;
	else
		return false;
}