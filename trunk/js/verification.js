function validCompte(field)
{

	if(verifPseudo(field.pseudo) && verifMail(field.mail) && verifMdp(field.password))
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