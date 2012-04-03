function notEmpty(field){

	
	if (field.value == ""){
		field.style.border = "solid red 2px";
		return false;
	}
	else{
		field.style.border = "solid green 2px";
		return true;
		
	}

}


function valid_sql(field){

	if(notEmpty(field.host) && notEmpty(field.user) && notEmpty(field.BDD))
		return true;

	else
		return false;
}
function valid_compte(field){
	if(notEmpty(field.login) && notEmpty(field.mdp) && verify.check() && notEmpty(field.mail))
		return true;

	else
		return false;
}
function init(field){
		field.value = "";
		return field;
}

function verif(field){
verify = new verifynotify();
verify.field1 = document.addAdmin.mdp;
verify.field2 = document.paddAdmin.mdp_verf;
verify.result_id = "password_result";
verify.match_html = "<SPAN STYLE=\"color:blue\">Les deux mot de passe sont identique<\/SPAN>";
verify.nomatch_html = "<SPAN STYLE=\"color:red\">Merci de revérifier les deux mots de passe<\/SPAN>";

// Update the result message
verify.check();
}
