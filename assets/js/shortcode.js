jQuery(document).ready( function($) {	
	
	$('.eawp').each(function() {

		var eawp_object = this;		
		var eawp_id = $(eawp_object).data('id');
		var eawp_url = $(eawp_object).data('url');
		var eawp_type = $(eawp_object).data('type');
		var eawp_loader = '<div class="eawp--load"><div class="eawp--loader">Loading...</div></div>';
		
		if( eawp_type == 'link' ) {

			$.ajax({
				url : eawp.ajax_url,
				type : 'GET',
				data : {
					action : 'eawp_ajax',
					id : eawp_id,
					url : eawp_url,
					type : eawp_type
				},
				success : function( response ) {
					$( eawp_object ).replaceWith( response );
				}
			});
			
		} else {		

			jQuery( eawp_object ).find( '.eawp--ajax' ).html(eawp_loader);

			$.ajax({
				url : eawp.ajax_url,
				type : 'GET',
				data : {
					action : 'eawp_ajax',
					id : eawp_id,
					url : eawp_url
				},
				success : function( response ) {
					setTimeout(function(){
						$( eawp_object ).find( '.eawp--ajax' ).html( response );
					}, 2000);
				}
			});
			
		}
		
	});
});