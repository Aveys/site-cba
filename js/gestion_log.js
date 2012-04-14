$(window).unload( function (){
	var xhr = getXhr()
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			xhr.responseText;
		}
	}
	xhr.open("GET","js/ajax_unload.php",false);
	xhr.send(null);
} );
$(window).load( function (){
	var xhr = getXhr()
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			document.getElementById("user_connect").innerHTML = xhr.responseText;
		}
	}
	xhr.open("GET","js/ajax_load.php",true);
	xhr.send(null);
} );
setInterval(function() {
    var xhr = getXhr()
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			document.getElementById("user_connect").innerHTML = xhr.responseText;
		}
	}
	xhr.open("GET","js/ajax_load.php",true);
	xhr.send(null);
}, 5000); //5 seconds
	function getXhr(){
                    var xhr = null; 
	if(window.XMLHttpRequest) // Firefox et autres
	   xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
	   try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
	}
	else { // XMLHttpRequest non supporté par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   xhr = false; 
	} 
    return xhr
}

function message_box_open(id,loggin)
{
	if(!document.getElementById("message_box_login_"+id))
	{
		document.getElementById("message_box").innerHTML += '<div tabindex="0" class="message_box_login" id="message_box_login_'+id+'" onFocus=change_couleur_message_box_login(1,"message_box_login_'+id+'") onBlur=change_couleur_message_box_login(0,"message_box_login_'+id+'")><h3 onclick=agrandir_reduire_messagerie_instantannee("affichage_envoie_message_'+id+'")>'+loggin+'</h3><div class="affichage_envoie_message" id="affichage_envoie_message_'+id+'"><div class="affiche_message_instantanne"></div><input type="text" name="message_a_envoyer" onFocus=change_couleur_message_box_login(1,"message_box_login_'+id+'") onBlur=change_couleur_message_box_login(0,"message_box_login_'+id+'") tabindex="0" /></div></div>';
	}
	document.getElementById("message_box_login_"+id).focus();
}

function agrandir_reduire_messagerie_instantannee(id)
{
	element = document.getElementById(id);
	if(element.style.height == "0px")
		element.style.height = "auto";
	else
		element.style.height = "0px";
}

function change_couleur_message_box_login(tmp,id)
{
	element = document.getElementById(id);
	if(tmp == 1)
	{
		element.style.backgroundColor="rgb(77,104,162)";
	}
	else if(tmp == 0)
	{
		element.style.backgroundColor="rgb(109,132,180)";
		element.blur();
	}
}