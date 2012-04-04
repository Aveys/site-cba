/*	affichage de l'apercu de l'equipe au survol d'un du menu equipe
*/
function survole_equipe_apercu(content)
{
	var scroll = getScrollPosition();
	var element = content.querySelector('#equipeListe');
	var element2 = content;
	var curleft = curtop = tmp = 0;
	if (element2.offsetParent) {
		do {
			if(element2.style.position != 'fixed')
			{
				tmp = element2.offsetTop;
				curtop += tmp;
			}
			else
			{
				curtop = element2.offsetTop+(tmp/2);
				curleft += 20;
			}
			curleft += element2.offsetLeft;
		} while (element2 = element2.offsetParent);
	}
	element.style.position = 'fixed';
	element.style.left = curleft-scroll[0]+"px";
	element.style.top = curtop-scroll[1]+15+"px";
	element.style.visibility='visible';
	element.style.height='auto';
	element.style.width='auto';
}
/*	va avec la fonction precedente et permet de cacher la div en question
*/
function quitte_equipe_apercu(content)
{
	var element = content.querySelector('#equipeListe');
	element.style.visibility='hidden';
	element.style.height='0px';
	element.style.width='0px';
}