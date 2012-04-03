function empty(t)
{
	if(t.value == "")
		t.className='errorInput';
	else
		t.className='validInput';
}