(function($){
	$.entwine('userswitcher', function($){

		$('form.userswitcher select').entwine({
			onchange : function(){
				this.parents('form:first').submit();
			}
		});

		$('form.userswitcher .Actions').entwine({
			onmatch : function(){
				this.hide();
			}
		});

		$('body').entwine({
			onmatch : function(){
				var base = $('base').prop('href');
				// if(this.hasClass('cms')){
				// 	return;
				// }
				

				$.get(base + 'home/UserSwitcherFormHTML', function(data){
	
					var body = $('body');

					if(body.hasClass('cms')){
						alert('here');
						$('.cms-login-status').append(data);
					}else{
						$('body').append(data);	
					}
				  	
				});

			}
		});
		
	});
})(jQuery);