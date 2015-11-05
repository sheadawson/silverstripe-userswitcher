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
				var base = $('base').prop('href'),
					isCMS = this.hasClass('cms') ? 1 : '';
				
				$.get(base + 'userswitcher/UserSwitcherFormHTML/', {userswitchercms: isCMS}).done(function(data){
					var body = $('body');

					if(body.hasClass('cms')){
						$('.cms-login-status').append(data);
					}else{
						$('body').append(data);	
					}
				  	
				});

			}
		});
		
	});
})(jQuery);

 
