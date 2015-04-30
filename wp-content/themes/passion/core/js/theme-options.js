// JavaScript Document
jQuery(document).ready(function($){	
	// Tabs
	listsTab = $("#wind-tabs a");
	if ( listsTab.length > 0 ) {
		currentTab = $('#currenttab').val();
		$(listsTab[currentTab]).addClass("wind-current");
	}

	$('#wind-wrapper .wind-pane').eq($('.wind-current').index()).show();
		
	$('#wind-tabs a').click(function() {
		$('#wind-tabs a').removeClass('wind-current');
		$(this).addClass('wind-current');
		$('#wind-wrapper .wind-pane').hide();
		$('#wind-wrapper .wind-pane').eq($(this).index()).show();
		$('#currenttab').val($(this).index());
	});
		 
    setTimeout(function () {
        $(".fade").fadeOut("slow", function () {
            $(".fade").remove();
        });

    }, 3000);

    // Image Loader
   	var image_uploader;
	
	$(".media-upload-btn").click(function(e){
		mediaUploader( e );
	});	
	$(".media-upload-del").click(function(e){
		mediaClear( e );
	});	
		
	function mediaClear( e ) {
        e.preventDefault();
		image_url = $(e.target).siblings('.media-upload-url');
		image_src = $(e.target).siblings('.media-upload-src');

		image_url.val( '' );
        image_src.attr ( 'src', '' );
	}

	function mediaUploader( e ) {
        e.preventDefault();

		image_url = $(e.target).siblings('.media-upload-url');
		image_src = $(e.target).siblings('.media-upload-src');
		
        if (image_uploader) {
            image_uploader.open();
            return;
        }
        image_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        image_uploader.on('select', function() {
            attachment = image_uploader.state().get('selection').first().toJSON();
            image_url.val( attachment.url );
            image_src.attr( 'src', attachment.url );
        });
 
        image_uploader.open();		
	}
// Multiple Categories selection
	var catColorPicker =  {
    	change: function(event, ui){
    		var hexcolor = $( this ).wpColorPicker( 'color' );
			$( this ).parent().find( '.color-picker' ).val( hexcolor );	
			windUpdateCategoryData( $(this).parents('.category-sortable') );
    	},
	};
	$( '.category-sortable .color-picker' ).wpColorPicker( catColorPicker );
	
	$( '.category-sortable' ).sortable({
		connectWith: '.connected',
		update: function( event, ui ){ windUpdateCategoryData( $(event.target) ) }
	});
	
	function windUpdateCategoryData( $target ) {
		if ( $target.is('.active') ) {
			var data = $target.children().map(function() {
	  			var $item = $(this);
	  			var hexcolor = '';
	  			if ( $item.find('.color-picker').length )
	  				hexcolor = $item.find('.color-picker').val();
  				return { 
				    id: $item.data('cat-id'), 
				    color: hexcolor,
  				};
			}).get();
			$target.parent().parent().find('.category-data').val( JSON.stringify(data ));
		}
	}

});

