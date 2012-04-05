function validCompte(field)
{
	if(verifLogin(field.pseudo) && verifMail(field.email) && verifPseudo(field.pseudo) && verifMdp(field.password) && verifStatus(field.status))
		return true;
	else
		return false;
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