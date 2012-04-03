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

function verify(){
var field1 = document.addAdmin.mdp;
var field2 = document.addAdmin.mdp_verf;
var message = document.getElementById("password_result");
if (field1.value != field2.value ){
		message.style.color = "red";
		message.innerHTML="Les deux mots de passe ne correspondent pas !"
		field1.style.border = "solid red 2px";
		field2.style.border = "solid red 2px";

		return false;

}else if(field1.value!='') {
	message.style.color = "green";
	message.innerHTML="Les deux mots de passe sont egaux !"
	field1.style.border = "solid green 2px";
	field2.style.border = "solid green 2px";
		return true;
}
else{
		message.style.color = "red";
		message.innerHTML="Le mot de passe ne peut etre vide !"
		field1.style.border = "solid red 2px";
		field2.style.border = "solid red 2px";
}
}
