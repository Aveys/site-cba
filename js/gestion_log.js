var messages_precedents = Array;
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
		var html_a_envoyer = ""
		html_a_envoyer += '<div tabindex="0" class="message_box_login" id="message_box_login_'+id+'" ';
			html_a_envoyer += 'onFocus=change_couleur_message_box_login(1,"message_box_login_'+id+'") ';
			html_a_envoyer += 'onBlur=change_couleur_message_box_login(0,"message_box_login_'+id+'")>';
				html_a_envoyer += '<h3 onclick=agrandir_reduire_messagerie_instantannee("affichage_envoie_message_'+id+'")>';
					html_a_envoyer += loggin;
					html_a_envoyer += '<div class="fermer_div_message_instannee" onclick=supprimer_div("message_box_login_'+id+'",'+id+') >x</div>';
				html_a_envoyer += '</h3>';
				html_a_envoyer += '<div class="affichage_envoie_message" id="affichage_envoie_message_'+id+'">';
					html_a_envoyer += '<div class="affiche_message_instantanne" id="affiche_message_instantanne_'+id+'"></div>';
					html_a_envoyer += '<input type="text" name="message_a_envoyer"';
						html_a_envoyer += ' onKeyPress="if(event.keyCode == 13){send_message('+id+',this);}" ';
						html_a_envoyer += 'onFocus=change_couleur_message_box_login(1,"message_box_login_'+id+'") '; 
						html_a_envoyer += 'onBlur=change_couleur_message_box_login(0,"message_box_login_'+id+'") tabindex="0" />';
				html_a_envoyer += '</div>';
		html_a_envoyer += '</div>';
		document.getElementById("message_box").innerHTML += html_a_envoyer;
		setInterval(function() {
			var element = document.getElementById("affiche_message_instantanne_"+id);
			var tmp = element.innerHTML;
 		    var xhr = getXhr()
			// On défini ce qu'on va faire quand on aura la réponse
			xhr.onreadystatechange = function(){
				// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
				if(xhr.readyState == 4 && xhr.status == 200){
					tmp = xhr.responseText;
					//alert(tmp);
					if(tmp != messages_precedents[id])
					{
						element.innerHTML = tmp;
						element.scrollTop = element.scrollHeight;
					}
					messages_precedents[id] = xhr.responseText;
				}
			}
			xhr.open("POST","js/ajax_affiche_messages.php",true);
			// ne pas oublier ça pour le post
			xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// ne pas oublier de poster les arguments
			xhr.send("user_id="+id);
		}, 1000); //5 seconds
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
		//displayClassElement(document.getElementById"message_box","message_box_login");
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

function send_message(receiver_id,input)
{
	var xhr = getXhr()
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			xhr.responseText;
		}
	}
	xhr.open("POST","js/ajax_send_message.php",true);
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	// ne pas oublier de poster les arguments
	xhr.send("receiver_id="+receiver_id+"&message="+input.value);
	input.value = "";
}

function displayClassElement(rootElement,className)
{
	var elmnt;
	nodes = new Array();
	if(typeof(rootElement) == 'string')
	{
		elmnt = document.getElementById(rootElement);
	}
	else
	{
		elmnt = rootElement;
	}
	if(elmnt.cells != undefined)
	{
		nodes = elmnt.cells; 
	}
	else
	{
		if(elmnt.rows != undefined)
		{
			nodes = elmnt.rows; 
		}
		else
		{
			if(elmnt.childNodes != undefined)
			{
				nodes = elmnt.childNodes;
			}
		}
	}
	for(var i = 0; i < nodes.length; i++)
	{
	    if(nodes[i].tagName != undefined)
	    {
	    	displayClassElement(nodes[i],className);
	    	if(nodes[i].className  ==  className)
	    	{
	    		nodes[i].style.display = getDisplayStyle(nodes[i]);
	    	}
	    }
	}
}
function supprimer_div(div_id,id)
{
	document.getElementById("message_box").removeChild(document.getElementById(div_id));
	messages_precedents[id] = "";
}