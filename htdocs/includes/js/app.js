$(function(){

	// fade in body
	$('body').fadeIn(600);
	// animate table
	$('.store-table tr').each(function(i, el){
		var $this = $(this)
		setTimeout(function(){
			$this.addClass('animated slideInLeft')
		}, i*500)
	})

}) // end of main function
