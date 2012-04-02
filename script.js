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


function valid(){
	var hostn = document.getElementsByName("hostn");
	var user = document.getElementsByName("user");
	var BDD = document.getElementsByName("BDD")
	if(notEmpty(hostn) && notEmpty(user) && notEmpty(BDD))
		return true;

	else
		return false;
}

function init(field){
		field.value = "";
		return field;
}
