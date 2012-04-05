jQuery(function($){
	
	/** 
   * Vérifications
   * Vérification des champs
   * */ 
  $('input').blur(function(){
    var input= $(this);
    if(input.val() == '')
    {
       input.next('span').remove();
       $('<span class="help-inline"/>').insertAfter(input).append('Le champ ne doit pas être vide !');
    }
    else
    {
      input.next('span').remove();
    }
  });
	 
	var domains = ['hotmail.com', 'gmail.com', 'wanadoo.fr', 'hotmail.fr', 'laposte.net', 'msn.com','etu.univ-savoie.fr', 'univ-savoie.fr'];
	$('.mailcheck').blur(function(){
		var input= $(this);
		input.mailcheck({
		domains: domains,
		suggested: function(element, suggestion){
			input.next('span').remove();
			$('<span class="help-inline"/>').insertAfter(input).append('Oups ! Vouliez vous ecrire <a href="#">'+suggestion.full+'</a> ?').find('a').click(function(e){
				e.preventDefault();
				input.val($(this).text());
				input.trigger('blur');
			});
		},
		empty: function(element){
			input.next('span').remove();
		}
		});
	});
<<<<<<< .mine
});

$('#clickme').click(function() {
  $('#formLogin').slideUp('slow', function() {
    // Animation complete.
  });
=======
	
	
>>>>>>> .r280
});