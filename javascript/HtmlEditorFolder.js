(function($){

	$.entwine('ss', function($) {

		// on cms state change (ie, new Page selected), destroy Media Form which forces it to reload
		$('.cms-container').entwine({
			onafterstatechange: function() {
				var form = $('#Form_EditorToolbarMediaForm');
				if( form.length ){
					form.closest('.ui-dialog').remove();
					form.closest('.htmleditorfield-dialog').remove();
					$('.cms-container').css('position','static'); // fixes weird scroll bug
				}
			}
		});

	});

}(jQuery));
