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
