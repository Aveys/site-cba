document.getElementById('submit').disabled = true;

function empty(t)
{	
	document.getElementById('test').value = "FALSE";
	if(t.value == "")
	{
		document.getElementById('content').value = "FALSE";
		t.className='errorInput';
		return FALSE;
	}
	else
	{
		document.getElementById('content').value = "TRUE";
		t.className='validInput';
		return TRUE;
	}
}

function validForm()
{
	if(document.getElementById('title').value.length != 0 && document.getElementById('content').value.length != 0)
	{
		document.getElementById('submit').disabled = true;
	}
	else
	{
		document.getElementById('submit').disabled = false;
	}

}