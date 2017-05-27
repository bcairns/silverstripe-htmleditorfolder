(function($){

	$.entwine('ss', function($) {

		// on cms state change (ie, new Page selected), destroy Media Form and Link Form which forces them to reload
		$('.cms-container').entwine({
			onafterstatechange: function() {
				var forms = $('#Form_EditorToolbarMediaForm,#Form_EditorToolbarLinkForm');
				if( forms.length ){
					forms.closest('.ui-dialog').remove();
					forms.closest('.htmleditorfield-dialog').remove();
					$('.cms-container').css('position','static'); // fixes weird scroll bug
				}
			}
		});

	});

}(jQuery));
