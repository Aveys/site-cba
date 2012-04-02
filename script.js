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


function valid(field){

	if(notEmpty(field.host) && notEmpty(field.user) && notEmpty(field.BDD))
		return true;

	else
		return false;
}

function init(field){
		field.value = "";
		return field;
}
