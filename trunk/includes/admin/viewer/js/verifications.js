function verifLogin(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifMdp(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifMail(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifPseudo(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifStatus(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifTitre(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifTags(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}

function verifText(field)
{
	if(field.value == '')
	{
		return false;
	}
	else
	{
		return true;
	}
}


function validArticle(field)
{
	if(verifTitre(field.title) && verifTags(field.tags) && verifText(field.content))
		return true;
	else
		return false;
}

function validCompte(field)
{
	if(verifLogin(field.pseudo) && verifMail(field.email) && verifPseudo(field.pseudo) && verifMdp(field.password) && verifStatus(field.status))
		return true;
	else
		return false;
}

function afficher_cacher(affiche,cache)
{
	affichage_champ_fichier(affiche);
	cacher_champ_fichier(cache);
}

function affichage_champ_fichier(id)
{
	element = document.getElementById(id);
	if(id=="fichier_existant")
	{
	}
	else
		getfile(element);
	element.style.visibility = "visible";		
	element.style.height = "auto";
	element.style.width = "auto";
	afficher_image_uploadee(0);
}

function cacher_champs_fichier(cache1,cache2)
{
	cacher_champ_fichier(cache1);
	cacher_champ_fichier(cache2);
}

function cacher_champ_fichier(id)
{
	element = document.getElementById(id);
	element.style.visibility = "hidden";
	element.style.height = "0px";
	element.style.width = "0px";
	afficher_image_uploadee(1);
}
function getfile(input){
	input.querySelector('input').click();
}
function afficher_image_uploadee(tmp)
{
	element = document.GetElementById("miniature_image");
	if(tmp === 1)
	{
		element.style.visibility="visible";
	}
	else
	{
		element.style.visibility="hidden";
	}
}
function change_image(option)
{
	element = document.getElementById("miniature_image");
	element.src = "../../../"+option.options[option.selectedIndex].value;
}
function redimImage(inMW, inMH,element)
{
  // Cette function recoit 3 parametres
  // inImg : Chemin relatif de l'image
  // inMW  : Largeur maximale
  // inMH   : Hauteur maximale
  var maxWidth = inMW;
  var maxHeight = inMH;
  // Declarations des variables "Nouvelle Taille"
  var dW = 0;
  var dH = 0;
  // On recupere les tailles reelles
  var h = dH = element.height;
  var w = dW = element.width;
  // Si la largeur ou la hauteur depasse la taille maximale
  if ((h >= maxHeight) || (w >= maxWidth)) {
    // Si la largeur et la hauteur depasse la taille maximale
    if ((h >= maxHeight) && (w >= maxWidth)) {
      // On cherche la plus grande valeur
      if (h > w) {
        dH = maxHeight;
        // On recalcule la taille proportionnellement
        dW = parseInt((w * dH) / h, 10);
      } else {
        dW = maxWidth;
        // On recalcule la taille proportionnellement
        dH = parseInt((h * dW) / w, 10);
      }
    } else if ((h > maxHeight) && (w < maxWidth)) {
      // Si la hauteur depasse la taille maximale
      dH = maxHeight;
        // On recalcule la taille proportionnellement
      dW = parseInt((w * dH) / h, 10);
    } else if ((h < maxHeight) && (w > maxWidth)) {
      // Si la largeur depasse la taille maximale
      dW = maxWidth;
        // On recalcule la taille proportionnellement
      dH = parseInt((h * dW) / w, 10);
    }
  }
  // On ecrit l'image dans le document
  element.width = dW;
  element.height = dH;
};