var nb_new_message = 0;
var cpt_affichage_titre_page = 0;
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
setInterval(function() {
	var xhr = getXhr()
	var oData;
	if(nb_new_message > 0 && cpt_affichage_titre_page > 0)
	{
		cpt_affichage_titre_page = -1;
		document.title = nb_new_message+" message(s)";
	}
	else
	{
		document.title = titre;
	}
	cpt_affichage_titre_page++;
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			readData(xhr.responseXML);
		}
	}
	xhr.open("GET","js/ajax_search_new_message.php?id="+sid,false);
	// ne pas oublier de poster les arguments
	xhr.send(null);
}, 1000); //1 seconde

function readData(oData) {
	var nodes   = oData.getElementsByTagName("item");
	var oOption, oInner,id_message,element,correspondant,xhr2;
	for (var i=0, c=nodes.length; i<c; i++) {
		correspondant = nodes[i].getAttribute("id");
		correspondant_login = nodes[i].getAttribute("login");
		id_message = nodes[i].getAttribute("id_message");
		is_sender = nodes[i].getAttribute("is_sender");
		message_box_open(correspondant,correspondant_login,1);
		if(is_sender == 0)
		{
			element_box = document.getElementById("message_box_login_"+correspondant);
			element_box.style.backgroundColor = "red";
		}
		element = document.getElementById("affiche_message_instantanne_"+correspondant);
		xhr2 = getXhr()
		// On défini ce qu'on va faire quand on aura la réponse
		xhr2.onreadystatechange = function(){
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(xhr2.readyState == 4 && xhr2.status == 200){
				element.innerHTML += xhr2.responseText;
				element.scrollTop = element.scrollHeight;
			}
		}
		xhr2.open("POST","js/ajax_affiche_messages.php",false);
		// ne pas oublier ça pour le post
		xhr2.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		// ne pas oublier de poster les arguments
		xhr2.send("id_message="+id_message);
		nb_new_message++;
	}
}

function message_box_open(id,loggin,new_message)
{
	if(!document.getElementById("message_box_login_"+id))
	{
		var html_a_envoyer = ""
		html_a_envoyer += '<div tabindex="0" class="message_box_login" id="message_box_login_'+id+'" ';
			html_a_envoyer += 'onFocus=change_couleur_message_box_login(1,'+id+') ';
			html_a_envoyer += 'onBlur=change_couleur_message_box_login(0,'+id+')>';
				html_a_envoyer += '<h3 onclick=agrandir_reduire_messagerie_instantannee('+id+')>';
					html_a_envoyer += loggin;
					html_a_envoyer += '<div class="fermer_div_message_instannee" onclick=supprimer_div("message_box_login_'+id+'",'+id+') >x</div>';
				html_a_envoyer += '</h3>';
				html_a_envoyer += '<div class="affichage_envoie_message" id="affichage_envoie_message_'+id+'">';
					html_a_envoyer += '<div class="affiche_message_instantanne" id="affiche_message_instantanne_'+id+'"></div>';
					html_a_envoyer += '<input type="text" name="message_a_envoyer" id="input_text_message_instantannee_'+id+'" ';
						html_a_envoyer += ' onKeyPress="if(event.keyCode == 13){send_message('+id+',this);}" ';
						html_a_envoyer += 'onFocus=change_couleur_message_box_login(1,'+id+') '; 
						html_a_envoyer += 'onBlur=change_couleur_message_box_login(0,'+id+') tabindex="0" />';
				html_a_envoyer += '</div>';
		html_a_envoyer += '</div>';
		document.getElementById("message_box").innerHTML += html_a_envoyer;
		element = document.getElementById("affiche_message_instantanne_"+id);
		xhr_load_message = getXhr();
		// On défini ce qu'on va faire quand on aura la réponse
		xhr_load_message.onreadystatechange = function(){
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(xhr_load_message.readyState == 4 && xhr_load_message.status == 200){
				element.innerHTML = xhr_load_message.responseText;
				element.scrollTop = element.scrollHeight;
			}
		}
		xhr_load_message.open("GET","js/ajax_load_all_message.php?id="+id,false);
		// ne pas oublier de poster les arguments
		xhr_load_message.send(null);
	}
	if(!new_message)
		document.getElementById("input_text_message_instantannee_"+id).focus();
}

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

function agrandir_reduire_messagerie_instantannee(id)
{
	element = document.getElementById("affichage_envoie_message_"+id);
	element_box = document.getElementById("message_box_login_"+id);
	if(element.style.height == "0px")
	{
		element.style.height = "auto";
		element_box.style.width = "275px";
	}
	else
	{
		element.style.height = "0px";
		element_box.style.width = "200px";
	}
}

function change_couleur_message_box_login(tmp,id)
{
	element = document.getElementById("message_box_login_"+id);
	if(tmp == 1)
	{
		element.style.backgroundColor="rgb(77,104,162)";
		nb_new_message--;
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
	xhr.send("receiver_id="+encodeURIComponent(receiver_id)+"&message="+encodeURIComponent(input.value));
	input.value = "";
}
function supprimer_div(div_id,id)
{
	document.getElementById("message_box").removeChild(document.getElementById(div_id));
}