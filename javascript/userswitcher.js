(function($){
	function loadSwitcher() {
		var base = $('base').prop('href');
		var isCMS = $('body').hasClass('cms') ? 1 : 0;

		$.get(base + 'userswitcher/UserSwitcherFormHTML/', {userswitchercms: isCMS, ajax: 1}).done(function(data){
			var $data = $(data);
			if (!$data.length) {
				return;
			}
			// Submit form on change
			$data.find('select').on('change', function() {
				$(this.form).submit();
			});
			// Hide submit button
			$data.find('.Actions').hide();

			var userSwitcherContainer = $('body');

			if ($('#userSwitcher').length){
			    userSwitcherContainer = $('#userSwitcher');
            }

			if($('body').hasClass('cms')){
                userSwitcherContainer = $('.cms-login-status');
			}

			userSwitcherContainer.append($data);
		});
	}

	function main() {
		var isCMS = $('body').hasClass('cms') ? 1 : 0;
		if (!$.entwine || !isCMS) {
			loadSwitcher();
		} else {
			$.entwine('userswitcher', function($){
				$('body').entwine({
					onmatch : function(){
						loadSwitcher();
						this._super();
					},
					onunmatch: function() {
						this._super();
					}
				});
			});
		}
	}
	main();
})(jQuery);


