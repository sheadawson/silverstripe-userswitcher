(function($) {    
    $(document).ready(function() {

		var switcher = $('form.userswitcher');	
		var select = switcher.find('select');
		var actions = switcher.find('.Actions').hide();

		select.change(function(){
			switcher.submit();
		});

	});
}(jQuery));