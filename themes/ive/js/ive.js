(function($, Drupal, drupalSettings){
	$(document).ready(function(){
		//alert('Hello');
		$("a[href^='http']").attr('target','_blank');

		$(".node a[href^='http']").css('color','red');

		//$( "<p>Toto</p>" ).insertBefore( ".node a" );
		$(".node a[href^='http']").addClass('external-link');

		$(".sidebar .block h2").click(function() {
			//$(this).parent().find('.content').toggle();
			$(this).siblings('.content').slideToggle('fast');
			//console.log('Test');	
		});
	});

}) (jQuery, Drupal, drupalSettings);