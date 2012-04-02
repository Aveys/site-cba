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
	if(notEmpty(field.login) && notEmpty(field.mdp) && verif(field.mdp_verf) && notEmpty(field.mail))
		return true;

	else
		return false;
}
function init(field){
		field.value = "";
		return field;
}

function verif(field){
if(field.value = document.addAdmin.mdp.value){
	field.style.border = "solid green 2px";
		return true;
}
else{
	field.style.border = "solid red 2px";
	return false;
}
}